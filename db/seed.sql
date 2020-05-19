DELETE FROM pathology_connect;
DELETE FROM surgery;
DELETE FROM patient;
DELETE FROM pathology;
DELETE FROM insurance;

-- insurance inserts
INSERT INTO insurance
(name)
VALUES
('Cigna');

INSERT INTO insurance
(name)
VALUES
('Blue Cross');

INSERT INTO insurance
(name)
VALUES
('United Health Care');

INSERT INTO insurance
(name)
VALUES
('Humana');

-- pathology inserts
INSERT INTO pathology 
(pathology)
VALUES 
('Abscess');

INSERT INTO pathology 
(pathology)
VALUES 
('Peritoneum-Other');

INSERT INTO pathology 
(pathology)
VALUES 
('Afib');

-- patient inserts
INSERT INTO patient
( record_num
, f_name
, l_name
, dob 
, insurance_id)
VALUES 
( 1
, 'Test'
, 'Tester'
, '10-4-1992'
, (SELECT insurance_id FROM insurance WHERE name = 'Cigna'));

INSERT INTO patient
( record_num
, f_name
, l_name
, dob 
, insurance_id)
VALUES 
( 8
, 'John'
, 'Doe'
, '2-21-1986'
, (SELECT insurance_id FROM insurance WHERE name = 'United Health Care'));

INSERT INTO patient
( record_num
, f_name
, l_name
, dob 
, insurance_id)
VALUES 
( 12
, 'Jane'
, 'Doe'
, '11-30-1988'
, (SELECT insurance_id FROM insurance WHERE name = 'United Health Care'));

-- surgery inserts
INSERT INTO surgery 
( patient_id
, surgery_date
, age
, procedure 
, procedure_duration 
, blood_loss 
, specimen_weight 
, notes)
VALUES 
( 12 
, '5-4-2019'
, 30
, 'Heart Biopsy'
, 30
, 3
, 5
, 'Laproscopic Access');

INSERT INTO surgery 
( patient_id
, surgery_date
, age
, procedure 
, procedure_duration 
, blood_loss 
, specimen_weight)
VALUES 
( 12
, '5-4-2020'
, 31
, 'Pacemaker Implant'
, 34
, 3
, NULL);

INSERT INTO surgery 
( patient_id
, surgery_date
, age
, procedure 
, procedure_duration 
, blood_loss 
, specimen_weight)
VALUES 
( 1 
, '5-4-2020'
, 27
, 'Abscess removal'
, 62
, 5
, 120);

-- pathology connection inserts
INSERT INTO pathology_connect
( surgery_id
, pathology_id)
VALUES
( (SELECT surgery_id FROM surgery WHERE surgery_date = '5-4-2020' AND patient_id = 1)
, (SELECT pathology_id FROM pathology WHERE pathology = 'Abscess'));

INSERT INTO pathology_connect
( surgery_id
, pathology_id)
VALUES
( (SELECT surgery_id FROM surgery WHERE surgery_date = '5-4-2019' AND patient_id = 12)
, (SELECT pathology_id FROM pathology WHERE pathology = 'Afib'));