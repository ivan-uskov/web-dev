PROGRAM z4(INPUT, OUTPUT);
USES Dos;
VAR
  s: STRING;  
BEGIN
  WRITELN('Content-Type: text/plain\n\n');
  WRITELN;
  s := GetEnv('QUERY_STRING');
  WRITELN(s);
END.
