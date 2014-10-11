PROGRAM z5(INPUT, OUTPUT);
USES 
  Dos;
VAR
  QueryStr, Arg: STRING;  
FUNCTION GetVal(QS: STRING; key: STRING): STRING;
VAR
  n: INTEGER;
  S: STRING;
BEGIN {GetVal} 
  S := '';
  Insert('&', QS, 1);
  Insert('&', QS, (Length(QS) + 1));
  Insert('&', key, 1);
  Insert('=', key, (Length(QS) + 1));
  n := POS(key, QS);
  IF n <> 0
  THEN
    BEGIN
      n := n + Length(key);
      WHILE QS[n] <> '&'  
      DO
        BEGIN
          Insert(QS[n], S, (Length(S) + 1));
          INC(n);  
        END;
      IF S = ''
      THEN
        S := 'Not Stated!';
      GetVal := S;
    END
  ELSE
    GetVal := 'Not Found!';
END; {GetVal}
BEGIN {z5}
  Arg := 'name';
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryStr := GetEnv('QUERY_STRING');
  IF QueryStr <> ''
  THEN
    WRITELN('Query String = ', QueryStr)
  ELSE                                  
    WRITELN('Query String Not Stated!');
  WRITELN(Arg, ' = ', GetVal(QueryStr, Arg));
END. {z5}