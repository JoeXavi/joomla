DROP function if exists json_extract_c; 

CREATE FUNCTION json_extract_c(
details TEXT,
required_field VARCHAR (255)
) RETURNS TEXT
BEGIN
  DECLARE search_term, val TEXT;
  DECLARE pos INT signed DEFAULT 1;

  -- Remove '{' and '}'
  SET details = SUBSTRING_INDEX(details, "{", -1);
  SET details = SUBSTRING_INDEX(details, "}", 1);
  -- Transform '$.xx' to be '"xx"'
  SET search_term = CONCAT('"', SUBSTRING_INDEX(required_field,'$.', - 1), '"');

  searching: LOOP
    SET pos = LOCATE(search_term, details);
    -- Keep searching if the field contains escape chars
    WHILE pos > 0 AND RIGHT(LEFT(details, pos-1), 1) = '\\'
    DO
      SET details = SUBSTR(details, pos+LENGTH(search_term));
      SET pos = LOCATE(search_term, details);
    END WHILE;
    -- Return NULL if not found
    IF pos <= 0 THEN
      RETURN NULL;
    END IF;

    SET pos = LENGTH(search_term)+pos;
    SET details = SUBSTR(details, pos);
    SET val = TRIM(details);

    -- see if we reach the value that is a leading colon ':'
    IF LEFT(val, 1) = ':' THEN
      RETURN TRIM(
        TRAILING ',' FROM 
        TRIM(
          SUBSTRING_INDEX(
            TRIM(
              BOTH '"' FROM TRIM(
                SUBSTR(
                  val
                , 2
                )
              )
            )
          , '"', 1
          )
        )
      );
    ELSE
      ITERATE searching;
    END IF;
  END LOOP;
END 


