DELETE FROM pathology_connect;
DELETE FROM surgery;
DELETE FROM patient;
DELETE FROM pathology;
DELETE FROM insurance;

DROP TABLE pathology_connect;
DROP TABLE surgery;
DROP TABLE patient;
DROP TABLE pathology;
DROP TABLE insurance;

CREATE TABLE insurance (
   insurance_id SERIAL primary key
   , name VARCHAR(45) NOT NULL
);

CREATE TABLE pathology (
   pathology_id SERIAL PRIMARY KEY
   , pathology VARCHAR(100) NOT NULL
);

CREATE TABLE patient (
   record_num int PRIMARY KEY
   , f_name VARCHAR(100) NOT NULL
   , l_name VARCHAR(100) NOT NULL
   , dob DATE NOT NULL
   , insurance_id int
   , FOREIGN KEY (insurance_id) REFERENCES insurance (insurance_id)
); 

CREATE TABLE surgery (
   surgery_id SERIAL PRIMARY KEY
   , patient_id int NOT NULL
   , age int NOT NULL
   , surgery_date DATE NOT NULL
   , procedure VARCHAR(100) NOT NULL
   , procedure_duration INT
   , blood_loss INT 
   , specimen_weight INT 
   , notes VARCHAR(255)
   , FOREIGN KEY (patient_id) REFERENCES patient (record_num)
);

CREATE TABLE pathology_connect (
   pathology_connect_id SERIAL PRIMARY KEY
   , surgery_id int NOT NULL 
   , pathology_id int NOT NULL 
   , FOREIGN KEY (surgery_id) REFERENCES surgery (surgery_id)
   , FOREIGN KEY (pathology_id) REFERENCES pathology (pathology_id)
);