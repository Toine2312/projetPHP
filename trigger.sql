CREATE or REPLACE TRIGGER T_B_IU_RDV 
BEFORE INSERT on rdv
FOR EACH ROW
BEGIN 

	DECLARE NB_RDV_JOURHEURE INTEGER;
	DECLARE HEURE_DEB TIME;
	DECLARE HEURE_FIN TIME;
	DECLARE DEJA_OCCUPE CONDITION FOR -1000;
	DECLARE EXIT HANDLER FOR DEJA_OCCUPE SET @error ='Le créneau est deja occupé';

	HEURE_DEB = new.heure - new.duree;
	HEURE_FIN = new.heure + new.duree;
	
	SELECT COUNT(*) INTO NB_RDV_JOURHEURE FROM rdv WHERE dateRdv = new.dateRdv and idMed= new.idMed and heure between HEURE_DEB and HEURE_FIN;

	IF (NB_RDV_JOURHEURE != 0 ) THEN
		SIGNAL DEJA_OCCUPE;
	END IF;
	
END;