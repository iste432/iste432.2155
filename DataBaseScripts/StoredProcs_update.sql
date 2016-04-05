
-- ted
DROP PROCEDURE IF EXISTS update_medication;
DROP PROCEDURE IF EXISTS update_contact_info;
DROP PROCEDURE IF EXISTS update_address;
DROP PROCEDURE IF EXISTS update_user;
DROP PROCEDURE IF EXISTS update_insurance;

-- jeremiah
DROP PROCEDURE IF EXISTS update_messages;
DROP PROCEDURE IF EXISTS update_addresspatient;
DROP PROCEDURE IF EXISTS update_patientaddress;
DROP PROCEDURE IF EXISTS update_prescription;
DROP PROCEDURE IF EXISTS update_appointment;

-- gary      
DROP PROCEDURE IF EXISTS update_practice;
DROP PROCEDURE IF EXISTS update_patient;
DROP PROCEDURE IF EXISTS update_physician;
DROP PROCEDURE IF EXISTS update_patientPhysician;

DELIMITER //

CREATE PROCEDURE update_medication
	(IN _medicationID int(11),
	IN _tradeName varchar(256),
	IN _genericName varchar(256),
	IN _genericCategory varchar(125),
	IN _therapeuticCategory varchar(125),
	IN _counselingPoints text)
	BEGIN
		-- create 
		UPDATE medication
      SET MedicationID = _medicationID, TradeName = _tradeName, GenericName = _genericName, GenericCategory = _genericCategory, 
      TherapeuticCategory = _therapeuticCategory, CounselingPoints = _counselingPoints 
		WHERE MedicationID =  _medicationID;
	END //
	
-- contactinfo UPDATE 
CREATE PROCEDURE update_contact_info
	(IN _contactID int(11),
	IN _phone char(10),
	IN _email varchar(30))
	BEGIN
		-- create contact
		UPDATE contactinfo
      SET ContactID = _contactID, Phone = _phone, Email = _email 
		WHERE ContactID = _contactID;
	END //	


-- address UPDATE 
CREATE PROCEDURE update_address
	(IN _addressID varchar(10),
	IN _street varchar(30),
	IN _city varchar(30),
	IN _state varchar(2),
	IN _zip varchar(5))
	BEGIN
		-- create addr
		UPDATE address 
      SET AddressID = _addressID, Street = _street, City = _city, `State` = _state, Zip = _zip
      WHERE AddressID = _addressID;
	END //


-- user UPDATE 	
CREATE PROCEDURE update_user
	(IN _userID varchar(50),
	IN _password varchar(256),
	IN _accountType char(3))
	BEGIN
		-- create user
		UPDATE `user`
      SET UserID = _userID, `Password`= _password, AccountType = _accountType 
		WHERE UserID = _userID;
	END //


-- user insurance 	
CREATE PROCEDURE update_insurance
	(IN _insuranceID varchar(10),
	IN _name varchar(30),
	IN _addressID varchar(10),
	IN _contactID int(11))
	BEGIN
		-- create ins
		UPDATE insurance
      SET InsuranceID = _insuranceID, Name = _name, AddressID = _addressID, ContactID = _contactID 
		WHERE InsuranceID = _insuranceID;
	END //


-- jeremiah
CREATE PROCEDURE update_messages
(IN messid INT(11), 
IN send VARCHAR(15), 
IN receive VARCHAR(15), 
IN subj VARCHAR(100), 
IN bod VARCHAR(1000), 
IN stat VARCHAR(10), 
IN dat DATETIME)
BEGIN
	UPDATE messages 
   SET MessageID = messid, Sender = send, Receiver = receive, Subject = subj, `Body` = bod, Status = stat, `Date` = dat
	WHERE MessageID = messid;
END //

CREATE PROCEDURE update_addresspatient
(IN patid VARCHAR(15), 
IN addrid VARCHAR(10))
BEGIN
	UPDATE addresspatient 
   SET PatientID = patid, AddressID = addrid
	WHERE AddressID = addrid;
END //

CREATE PROCEDURE update_patientaddress
(IN patient_id VARCHAR(15), 
IN address_id VARCHAR(10))
BEGIN
	UPDATE addresspatient 
   SET PatientID = patient_id, AddressID = address_id
	WHERE PatientID = patient_id;
END //

CREATE PROCEDURE update_prescription
(IN prescid INT(11), 
IN medid INT(11), 
IN physID VARCHAR(15), 
IN patID VARCHAR(15), 
IN dos VARCHAR(50), 
IN refi INT(11), 
IN expdat DATE, 
IN freq VARCHAR(50), 
IN rout VARCHAR(50))
BEGIN
	UPDATE prescription 
   SET PrescriptionID = prescid, MedicationID = medid, PhysicianID = physID, PatientID = patID, Dosage = dos, Refills = refi, ExpDate = expdat, Frequency = freq, Route = rout
	WHERE PrescriptionID = prescid;
END //

CREATE PROCEDURE update_appointment
(IN apptid VARCHAR(10), 
IN patId VARCHAR(15), 
IN physId VARCHAR(15), 
IN insurid VARCHAR(10), 
IN datt DATE, 
IN addressid VARCHAR(10), 
IN purp VARCHAR(50), 
IN descr TEXT, 
IN status VARCHAR(15))
BEGIN
	UPDATE appointment 
   SET AppointmentID = apptid, PatientID = patId, PhysicianID = physId, InsuranceID = insurid, `Date` = datt, AddressID = addressid, Purpose = purp, Description = descr, Status = status
	WHERE AppointmentID = apptid;
END //


-- gary
CREATE PROCEDURE update_practice
(IN prctID INT(11), 
IN prName VARCHAR(256), 
IN conID INT(11), 
IN addrID VARCHAR(10))
BEGIN
	UPDATE Practice 
   SET PracticeID = prctID, Name = prName, ContactID = conID, AddressID = addrID
	WHERE PracticeID = prctID;
END//

CREATE PROCEDURE update_patient
(IN patID VARCHAR(15), 
IN usrID VARCHAR(50), 
IN pname VARCHAR(75), 
IN soc CHAR(9), 
IN medID CHAR(10), 
IN pWeight INT(11), 
IN birth DATE, 
IN physID VARCHAR(15),
IN addrID VARCHAR(10), 
IN insID VARCHAR(10), 
IN conID INT(11))
BEGIN
	UPDATE Patient 
   SET PatientID = patID, UserID = usrID, Name = pname, SSN = soc, 
   MedicareID = medID, Weight = pWeight, DOB = birth, PhysicianID = physID, 
	AddressID = addrID, InsuranceID = insID, ContactID = conID
	WHERE PatientID = patID;	
END//

CREATE PROCEDURE update_physician
(IN physID VARCHAR(15), 
IN phName VARCHAR(125), 
IN spec VARCHAR(125), 
IN newPat TINYINT(1), 
IN insID VARCHAR(10), 
usrID VARCHAR(50))
BEGIN
	UPDATE Physician 
   SET PhysicianID = physID, Name = phName, Specialty = spec, 
	NewPatient = newPat, InsuranceID = insID, UserID = usrID
	WHERE PhysicianID = physID;
END//

CREATE PROCEDURE update_patientPhysician
(IN patID VARCHAR(15), 
IN physID VARCHAR(15))
BEGIN
	UPDATE PatientPhysician SET PatientID = patID, PhysicianID = physID
	WHERE PatientID = patID;
END//

DELIMITER ;