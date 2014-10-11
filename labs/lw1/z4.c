#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(void)
{
    char* data;
    printf("Content-Type: text/plain\n\n");
    data = getenv("QUERY_STRING");
    printf("Query_String = '%s'", data);
    return 0;
}
