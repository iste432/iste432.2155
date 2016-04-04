DELIMITER ;
USE iste432a;

DROP PROCEDURE IF EXISTS select_appointment;
DROP PROCEDURE IF EXISTS select_messages;
DROP PROCEDURE IF EXISTS select_user;
DROP PROCEDURE IF EXISTS select_address;
DROP PROCEDURE IF EXISTS select_medication;
DROP PROCEDURE IF EXISTS select_refillrequest;

DROP PROCEDURE IF EXISTS select_contactinfo;
DROP PROCEDURE IF EXISTS select_insurance;
DROP PROCEDURE IF EXISTS select_patient;
DROP PROCEDURE IF EXISTS select_prescription;
DROP PROCEDURE IF EXISTS select_patientphysician;
DROP PROCEDURE IF EXISTS select_physicianpatient;

DELIMITER //


CREATE PROCEDURE select_appointment(IN apptID VARCHAR(10))
BEGIN
	SELECT * FROM appointment WHERE AppointmentID = apptID;
END//


CREATE PROCEDURE select_messages(IN msgID INT(11))
BEGIN
	SELECT * FROM messages WHERE MessageID = msgID;
END//

CREATE PROCEDURE select_user(IN usrID INT)
BEGIN
	SELECT * FROM `user` WHERE UserID = usrID;
END//

CREATE PROCEDURE select_address(IN addrID VARCHAR(10))
BEGIN
	SELECT * FROM address WHERE AddressID = addrID;
END//

CREATE PROCEDURE select_medication(IN medID INT(11))
BEGIN
	SELECT * FROM medication WHERE MedicationID = medID;
END//

CREATE PROCEDURE select_refillrequest(IN prescriptionID INT(11), IN dateCreated DATE)
BEGIN
	SELECT * FROM refillrequest WHERE PrescriptionID = prescriptionID AND DateCreated = dateCreated;
END//

CREATE PROCEDURE select_contactinfo(IN contactid INT(11))
BEGIN
	SELECT * FROM contactinfo WHERE ContactID = contactid;
END//

CREATE PROCEDURE select_insurance(IN insuranceid VARCHAR(10))
BEGIN
	SELECT * FROM insurance WHERE InsuranceID = insuranceid;
END//

CREATE PROCEDURE select_patient(IN patientid VARCHAR(15))
BEGIN
	SELECT * FROM patient WHERE PatientID = patientid;
END//

CREATE PROCEDURE select_prescription(IN prescriptionid INT(11))
BEGIN
	SELECT * FROM prescription WHERE PrescriptionID = prescriptionid;
END//

CREATE PROCEDURE select_patientphysician(IN patient_id VARCHAR(15))
BEGIN
	SELECT * FROM patientphysician WHERE PatientID = patient_id;
END//

CREATE PROCEDURE select_physicianpatient(IN physician_id VARCHAR(15))
BEGIN
	SELECT * FROM patientphysician WHERE PhysicianID = physician_id;
END//

DELIMITER ;