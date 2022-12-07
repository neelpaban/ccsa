Lex program to check whether input is a digit or not.

%{
#include<stdio.h>
#include<stdlib.h>
%}
/* Rule Section */
%%
^[0-9]* printf("digit");
^[^0-9]|[0-9]*[a-zA-Z] printf("not a digit");
. ;
%%
int yywrap(void){}
int main()
{
// The function that starts the analysis
yylex();
return 0;
}

-------------------------------------------------------------------

Lex code to determine whether the given number is even or odd.


%{
#include<stdio.h>
int i;
%}
%%
[0-9]+ {i=atoi(yytext);
if(i%2==0)
printf("Even");
else
printf("Odd");
}
%%
int yywrap(){}
int main()
{
printf("Enter the number:");
yylex();
return 0;
}

-------------------------------------------------------------------

Lex code to check whether a number is prime or not.


%{
#include<stdio.h>
#include<stdlib.h>
int flag,c,j;
%}
%%
[0-9]+ {c=atoi(yytext);
if(c==2)
{
printf("\n Prime Number.");
}
else if(c==0||c==1)
{
printf("\n Not a prime number.");
}
else
{
for(j=2;j<c;j++)
{
if(c%j==0);
flag=1;
}
if(flag==1)
printf("\n Not a prime number.");
else if(flag==0)
printf("\n Prime number.");
}
}
%%
int yywrap(){}
int main()
{
printf("Enter any number:");
yylex();
return 0;
}


-------------------------------------------------------------------

Lex program to count total number of tokens.

%{
int n=0;
%}
%%
"while"|"if"|"else" {n++;printf("\t keywords :%s",yytext);}
"int"|"float" {n++;printf("\tkeywords: %s",yytext);}
[a-zA-Z_][a-zA-Z0-9_]* {n++;printf("\t identifier: %s",yytext);}
"<="|"=="|"="|"++"|"-"|"*"|"+" {n++;printf("\t operator: %s",yytext);}
[(){}|,;] {n++;printf("\t separator: %s",yytext);}
[0-9]*"."[0-9]+ {n++;printf("\t float: %s",yytext);}
[0-9]+ {n++;printf("\t integer: %s",yytext);}
.;
%%
int yywrap(){}
int main()
{
yylex();
printf("\n total no. of token=%d\n",n);
}

-------------------------------------------------------------------

Lex program to implement a single calculation.


%{
#include<stdio.h>
int op=0,i;
float a,b;
%}
dig [0-9]+|([0-9]*)"."([0-9]+)
add "+"
sub "-"
mul "*"
div "/"
pow "^"
ln \n
%%
{dig} {digi();}
{add} {op=1;}
{sub} {op=2;}
{mul} {op=3;}
{div} {op=4;}
{pow} {op=5;}
{ln} {printf("\n The answer:%f\n\n",a);}
%%
digi()
{
if(op==0)
a=atof(yytext);
else
{
b=atof(yytext);
switch(op)
{
case 1:a=a+b;
break;
case 2:a=a-b;
break;
case 3:a=a*b;
break;
case 4:a=a/b;
break;
case 5:for(i=a;b>1;b--)
a=a*i;
break;
}
op=0;
}
}
int main(int argv,char *argc[])
{
yylex();
}
yywrap()
{
return 1;
}

-------------------------------------------------------------------

Lex program to count number of words.


%{
#include<stdio.h>
#include<string.h>
int i=0;
%}
%%
([a-zA-Z0-9])* {i++;}
"\n" {printf("%d\n",i); i=0;}
%%
int yywrap(void){}
int main()
{
yylex();
return 0;
}

-------------------------------------------------------------------

Lex program to determine whether input is an identifier or not.

%option noyywrap
%{
#include<stdio.h>
%}
%%
^[a-zA-Z_][a-zA-Z0-9_]* printf("Valid Identifier.");
^[^a-zA-Z_][a-zA-Z0-9_]* printf("Invalid Identifier.");
.;
%%
main()
{
yylex();
}

-------------------------------------------------------------------

Lex program to determine the length of a given string.

%{
#include<stdio.h>
int length;
%}
/* Rules Section*/
%%
[a-z A-Z 0-9]+ {length=yyleng;}
"\n" {printf("Length of given string is : %d\n", length);}
%%
int yywrap(){}
int main()
{
yylex();
return 0;
}

-------------------------------------------------------------------

Lex program to count the number of vowels and consonants in a given string.


%{
#include<stdio.h>
int vow_count=0;
int const_count =0;
%}
%%
[aeiouAEIOU] {vow_count++;}
[a-z A-Z] {const_count++;}
"\n" {printf("Number of vowels are: %d\n", vow_count);
printf("Number of consonants are: %d\n", const_count);}
%%
int main(){
printf("Enter the string of vowels and consonents: ");
yylex();
return 0;
}

-------------------------------------------------------------------