/**
 * Author:  Marc
 * Created: 18-jun-2016
 */
CREATE DEFINER=`root`@`localhost` PROCEDURE `a_grupo_cantidad`()
BLOCK1:BEGIN
    DECLARE cnt INT Default 0;
      
    simple_loop: LOOP
      
		BLOCK2:BEGIN  

			DECLARE tablename CHAR(30);
			DECLARE done INT DEFAULT 0;			
			DECLARE nombre_grupo CHAR(30);  
			DECLARE cursor_nombre_grupo cursor FOR SELECT DISTINCT grupo FROM productos ORDER BY 1 ASC;    
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

			/*tabla*/   
	   		IF cnt=0 THEN	
				SET tablename ="a_grupo_cantidad";
			ELSEIF cnt=1 THEN
				SET tablename ="a_grupo_oferta_cantidad";
			END IF;					
                    
			/*drop table*/
			SET @sql_text = concat('DROP TABLE IF EXISTS ',tablename,';');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;  
            
            /*create table*/
			SET @sql_text = concat('CREATE TABLE IF NOT EXISTS ',tablename,' 
							(grupo CHAR(30) NOT NULL,
							cantidad SMALLINT UNSIGNED,
							cantidad_con_foto SMALLINT UNSIGNED);');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;                     
                    
			/*cursor*/
			OPEN cursor_nombre_grupo;
			REPEAT
			FETCH cursor_nombre_grupo INTO nombre_grupo;

			IF done=0 THEN
				IF cnt=0 THEN
					INSERT INTO a_grupo_cantidad VALUES(nombre_grupo, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND oferta =0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND imagen !='00000000' AND oferta =0));
				ELSEIF cnt=1 THEN
					INSERT INTO a_grupo_oferta_cantidad VALUES(nombre_grupo, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND oferta >0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND imagen !='00000000' AND oferta >0));
				END IF;				
			END IF;

			UNTIL done END REPEAT;
			CLOSE cursor_nombre_grupo;	
			
		END BLOCK2;  
		        
        IF cnt=1 THEN
        	DELETE FROM a_grupo_oferta_cantidad WHERE cantidad=0;	
        	LEAVE simple_loop;
        END IF;
        SET cnt=cnt+1;
	END LOOP simple_loop; 
END BLOCK1

CREATE DEFINER=`root`@`localhost` PROCEDURE `b_division_cantidad`()
BLOCK1:BEGIN
	DECLARE cnt INT Default 0;

	simple_loop: LOOP

		BLOCK2:BEGIN 

			DECLARE tablename CHAR(30);
			DECLARE done INT DEFAULT 0;
			DECLARE nombre_grupo CHAR(30);
			DECLARE cursor_nombre_grupo cursor FOR SELECT DISTINCT grupo FROM productos ORDER BY 1 ASC;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

			/*tabla*/   
	   		IF cnt=0 THEN	
				SET tablename ="b_division_cantidad";
			ELSEIF cnt=1 THEN
				SET tablename ="b_division_oferta_cantidad";
			END IF;					
                    
			/*drop table*/
			SET @sql_text = concat('DROP TABLE IF EXISTS ',tablename,';');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;  
            
            /*create table*/
			SET @sql_text = concat('CREATE TABLE IF NOT EXISTS ',tablename,' 
							(grupo CHAR(30) NOT NULL,
							division CHAR(40) NOT NULL,
							cantidad SMALLINT UNSIGNED,
							cantidad_con_foto SMALLINT UNSIGNED);');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt; 

			/*cursor*/
			OPEN cursor_nombre_grupo;
			REPEAT
			FETCH cursor_nombre_grupo INTO nombre_grupo;
			IF done=0 THEN

				BLOCK3:BEGIN
					DECLARE done1 INT DEFAULT 0;
					DECLARE nombre_division CHAR(40);
					DECLARE cursor_nombre_division cursor FOR SELECT DISTINCT division FROM productos where grupo=nombre_grupo;
					DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1=1;

					/*cursor*/
					OPEN cursor_nombre_division;
					REPEAT
					FETCH cursor_nombre_division INTO nombre_division;

					IF done1=0 THEN	
						IF cnt=0 THEN
							INSERT INTO b_division_cantidad VALUES(nombre_grupo,nombre_division, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND oferta =0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND imagen !='00000000' AND oferta =0));
						ELSEIF cnt=1 THEN
							INSERT INTO b_division_oferta_cantidad VALUES(nombre_grupo,nombre_division, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND oferta >0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND imagen !='00000000' AND oferta >0));
						END IF;

					END IF;
					UNTIL done1 END REPEAT;
					CLOSE cursor_nombre_division;
				END BLOCK3;	

			END IF;
			UNTIL done END REPEAT;
			CLOSE cursor_nombre_grupo;

		END BLOCK2; 

        IF cnt=1 THEN
        	DELETE FROM b_division_oferta_cantidad WHERE cantidad=0;	
        	LEAVE simple_loop;
        END IF;
        SET cnt=cnt+1;
	END LOOP simple_loop; 
END BLOCK1


CREATE DEFINER=`root`@`localhost` PROCEDURE `c_familia_cantidad`()
BLOCK1:BEGIN
    DECLARE cnt INT Default 0;
      
    simple_loop: LOOP

    	BLOCK2:BEGIN 

    		DECLARE tablename CHAR(30);
			DECLARE done INT DEFAULT 0;
			DECLARE nombre_grupo CHAR(30);
			DECLARE cursor_nombre_grupo cursor FOR SELECT DISTINCT grupo FROM productos ORDER BY 1 ASC;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

			/*tabla*/   
	   		IF cnt=0 THEN	
				SET tablename ="c_familia_cantidad";
			ELSEIF cnt=1 THEN
				SET tablename ="c_familia_oferta_cantidad";
			END IF;					
                    
			/*drop table*/
			SET @sql_text = concat('DROP TABLE IF EXISTS ',tablename,';');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;  
            
            /*create table*/
			SET @sql_text = concat('CREATE TABLE IF NOT EXISTS ',tablename,' 
							(grupo CHAR(30) NOT NULL,
							division CHAR(40) NOT NULL,
						    familia CHAR(40) NOT NULL,							
							cantidad SMALLINT UNSIGNED,
							cantidad_con_foto SMALLINT UNSIGNED);');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt; 

			/*cursor*/
			OPEN cursor_nombre_grupo;
			REPEAT
			FETCH cursor_nombre_grupo INTO nombre_grupo;
			IF done=0 THEN

				BLOCK3:BEGIN
					DECLARE done1 INT DEFAULT 0;
					DECLARE nombre_division CHAR(40);
					DECLARE cursor_nombre_division cursor FOR SELECT DISTINCT division FROM productos where grupo=nombre_grupo;
					DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1=1;

					/*cursor*/
					OPEN cursor_nombre_division;
					REPEAT
					FETCH cursor_nombre_division INTO nombre_division;

					IF done1=0 THEN	
						
						BLOCK4:BEGIN
							DECLARE done2 INT DEFAULT 0;
							DECLARE nombre_familia CHAR(40);
							DECLARE cursor_nombre_familia cursor FOR SELECT DISTINCT familia FROM productos where grupo=nombre_grupo AND division=nombre_division;
							DECLARE CONTINUE HANDLER FOR NOT FOUND SET done2=1;

							/*cursor*/
							OPEN cursor_nombre_familia;
							REPEAT
							FETCH cursor_nombre_familia INTO nombre_familia;

							IF done2=0 THEN	
								IF cnt=0 THEN
									INSERT INTO c_familia_cantidad VALUES(nombre_grupo,nombre_division,nombre_familia, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND oferta =0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND imagen !='00000000' AND oferta =0));
								ELSEIF cnt=1 THEN
									INSERT INTO c_familia_oferta_cantidad VALUES(nombre_grupo,nombre_division,nombre_familia, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND oferta >0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND imagen !='00000000' AND oferta >0));
								END IF;		
							END IF;
							UNTIL done2 END REPEAT;
							CLOSE cursor_nombre_familia;
						END BLOCK4;	
					
		            END IF;
					UNTIL done1 END REPEAT;
					CLOSE cursor_nombre_division;
				END BLOCK3;	

			END IF;
			UNTIL done END REPEAT;
			CLOSE cursor_nombre_grupo;

		END BLOCK2;  

        IF cnt=1 THEN
        	DELETE FROM c_familia_oferta_cantidad WHERE cantidad=0;	
        	LEAVE simple_loop;
        END IF;
        SET cnt=cnt+1;
	END LOOP simple_loop; 
END BLOCK1

CREATE DEFINER=`root`@`localhost` PROCEDURE `d_subfamilia_cantidad`()
BLOCK1:BEGIN
    DECLARE cnt INT Default 0;
      
    simple_loop: LOOP
      
		BLOCK2:BEGIN 

			DECLARE tablename CHAR(30);
			DECLARE done INT DEFAULT 0;
			DECLARE nombre_grupo CHAR(30);
			DECLARE cursor_nombre_grupo cursor FOR SELECT DISTINCT grupo FROM productos ORDER BY 1 ASC;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET done=1;

			/*tabla*/   
	   		IF cnt=0 THEN	
				SET tablename ="d_subfamilia_cantidad";
			ELSEIF cnt=1 THEN
				SET tablename ="d_subfamilia_oferta_cantidad";
			END IF;					
                    
			/*drop table*/
			SET @sql_text = concat('DROP TABLE IF EXISTS ',tablename,';');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;  
            
            /*create table*/
			SET @sql_text = concat('CREATE TABLE IF NOT EXISTS ',tablename,' 
							(grupo CHAR(30) NOT NULL,
							division CHAR(40) NOT NULL,
						    familia CHAR(40) NOT NULL,
						    subfamilia CHAR(41) NOT NULL,
							cantidad SMALLINT UNSIGNED,
							cantidad_con_foto SMALLINT UNSIGNED);');
			PREPARE stmt FROM @sql_text;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt; 

			/*cursor*/
			OPEN cursor_nombre_grupo;
			REPEAT
			FETCH cursor_nombre_grupo INTO nombre_grupo;
			IF done=0 THEN

				BLOCK3:BEGIN
					DECLARE done1 INT DEFAULT 0;
					DECLARE nombre_division CHAR(40);
					DECLARE cursor_nombre_division cursor FOR SELECT DISTINCT division FROM productos where grupo=nombre_grupo;
					DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1=1;

					/*cursor*/
					OPEN cursor_nombre_division;
					REPEAT
					FETCH cursor_nombre_division INTO nombre_division;

					IF done1=0 THEN	
						
						BLOCK4:BEGIN
							DECLARE done2 INT DEFAULT 0;
							DECLARE nombre_familia CHAR(40);
							DECLARE cursor_nombre_familia cursor FOR SELECT DISTINCT familia FROM productos where grupo=nombre_grupo AND division=nombre_division;
							DECLARE CONTINUE HANDLER FOR NOT FOUND SET done2=1;

							/*cursor*/
							OPEN cursor_nombre_familia;
							REPEAT
							FETCH cursor_nombre_familia INTO nombre_familia;

							IF done2=0 THEN	
		                    
								BLOCK5:BEGIN
									DECLARE done3 INT DEFAULT 0;
									DECLARE nombre_subfamilia CHAR(41);
									DECLARE cursor_nombre_subfamilia cursor FOR SELECT DISTINCT subfamilia FROM productos where grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia;
									DECLARE CONTINUE HANDLER FOR NOT FOUND SET done3=1;

									/*cursor*/
									OPEN cursor_nombre_subfamilia;
									REPEAT
									FETCH cursor_nombre_subfamilia INTO nombre_subfamilia;

									IF done3=0 THEN	
										IF cnt=0 THEN
											INSERT INTO d_subfamilia_cantidad VALUES(nombre_grupo,nombre_division,nombre_familia,nombre_subfamilia, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND subfamilia=nombre_subfamilia AND oferta =0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND subfamilia=nombre_subfamilia AND imagen !='00000000' AND oferta =0));
										ELSEIF cnt=1 THEN
											INSERT INTO d_subfamilia_oferta_cantidad VALUES(nombre_grupo,nombre_division,nombre_familia,nombre_subfamilia, (SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND subfamilia=nombre_subfamilia AND oferta >0),(SELECT COUNT(*) FROM productos WHERE grupo=nombre_grupo AND division=nombre_division AND familia=nombre_familia AND subfamilia=nombre_subfamilia AND imagen !='00000000' AND oferta >0));
										END IF;	
									END IF;
									UNTIL done3 END REPEAT;
									CLOSE cursor_nombre_subfamilia;
								END BLOCK5;	
							
		                    END IF;
							UNTIL done2 END REPEAT;
							CLOSE cursor_nombre_familia;
						END BLOCK4;	
					
		            END IF;
					UNTIL done1 END REPEAT;
					CLOSE cursor_nombre_division;
				END BLOCK3;	

			END IF;
			UNTIL done END REPEAT;
			CLOSE cursor_nombre_grupo;

		END BLOCK2; 

        IF cnt=1 THEN
        	DELETE FROM d_subfamilia_oferta_cantidad WHERE cantidad=0;	
        	LEAVE simple_loop;
        END IF;
        SET cnt=cnt+1;
	END LOOP simple_loop; 
END BLOCK1

CREATE DEFINER=`root`@`localhost` PROCEDURE `random_products`()
BLOCK1:BEGIN
	DECLARE done INT DEFAULT 0;
	DECLARE nombre_grupo CHAR(30);
	DECLARE cursor_grupo CURSOR FOR SELECT DISTINCT grupo FROM productos ORDER BY 1 ASC;
	DECLARE continue handler for not found set done=1;

	/*tabla*/
    DROP TABLE IF EXISTS f_random_products;
	CREATE TABLE IF NOT EXISTS f_random_products (
	grupo CHAR(30) NOT NULL,
	codigo_producto BIGINT(10) ZEROFILL UNSIGNED NOT NULL UNIQUE KEY,
	nombre_producto CHAR(60) NOT NULL,
	pvp DECIMAL(8,3) UNSIGNED NOT NULL,
	pvp_incrementado DECIMAL(8,3) UNSIGNED NOT NULL,
    oferta DECIMAL(8,3) UNSIGNED,
    valor_oferta boolean,
	imagen CHAR(8),
	INDEX idx_grupo (grupo(1) ASC),
	PRIMARY KEY (codigo_producto));

	DELETE FROM f_random_products;

	/*cursor*/
	OPEN cursor_grupo;
	REPEAT
	FETCH cursor_grupo into nombre_grupo;
	IF done=0  THEN	
		BLOCK2:BEGIN
        
			DECLARE done1 INT DEFAULT 0;
			DECLARE nombre_imagen CHAR(8);
			DECLARE cursor_nombre_imagen CURSOR FOR SELECT DISTINCT imagen FROM productos WHERE imagen !='00000000' AND grupo=nombre_grupo ORDER BY rand() LIMIT 12;
			DECLARE CONTINUE HANDLER FOR NOT FOUND SET done1=1;

			/*cursor*/
			OPEN cursor_nombre_imagen;
			REPEAT
			FETCH cursor_nombre_imagen INTO nombre_imagen;

			IF done1=0  THEN	
			
				INSERT INTO f_random_products (grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,oferta,valor_oferta) SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,oferta,IF(oferta>0, 1, 0) FROM productos WHERE grupo = nombre_grupo AND imagen=nombre_imagen ORDER BY RAND() LIMIT 1;
			
			END IF;

			UNTIL done1 END REPEAT;
			CLOSE cursor_nombre_imagen;
		
		END BLOCK2;
	END if;
	UNTIL done END REPEAT;
	CLOSE cursor_grupo;

	/*ver*/
	SELECT * FROM f_random_products ORDER BY grupo;
END BLOCK1

