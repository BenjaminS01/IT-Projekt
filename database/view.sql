CREATE VIEW `viewAreaEntryTimeslot` AS
select atet.id,  a.labelling, a.maxNumberOfPeople, te.trainingDate , te.trainingTime, te.typeOfTraining, ts.startDate, ts.endDate 
from AreaTrainingEntryTimeslot atet
join Area a on atet.areaId = a.id 
join Timeslot ts on atet.timeslotId = ts.id 
join TrainingEntry te on atet.areaId = te.id