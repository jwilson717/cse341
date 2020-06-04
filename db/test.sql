SELECT *
FROM Surgery s JOIN Patient p 
ON s.patient_id = p.record_num JOIN Insurance i 
on p.insurance_id = i.insurance_id LEFT JOIN Pathology_connect pc 
ON s.surgery_id = pc.surgery_id LEFT JOIN pathology pa 
ON pc.pathology_id = pa.pathology_id 
WHERE s.surgery_id = 1
ORDER BY s.surgery_date;

SELECT * 
FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
WHERE s.surgery_date = '2020-5-04'  AND p.f_name like '%Jane%' AND p.l_name like '%error%';

SELECT * 
FROM Surgery s JOIN Patient p on s.patient_id = p.record_num 
WHERE p.f_name like '%Jane%' OR p.l_name like '%error%';