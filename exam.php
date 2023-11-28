Exaple of Graphical Method:

Steps: install.packages("lpSolve")   or  import from local zip file ( Zip file may be downloaded also)


1. Codes to solve

Max Z=20X+60Z

Subject to,

30X+20Y<=2700
5X+10Y<=850
X+Y<=95

X,Y>= 0

> install.packages("lpSolve") 
> library("lpSolve")
> obj.fun<-c(20,60)
> constr<-matrix(c(30,20,5,10,1,1),ncol=2,byrow=TRUE)
> constr.dir<-c("<=","<=","<=")
> rhs<-c(2700,850,95)
> prod.sol<-lp("max",obj.fun,constr,constr.dir,rhs,compute.sens=TRUE)
> prod.sol
Success: the objective function is 5100 
> prod.sol$solution
[1]  0 85

( Compare the result manually)




2.  Similar Example

 library("lpSolve")
> obj.fun<-c(40,35)
> constr<-matrix(c(2,3,4,3),ncol=2,byrow=TRUE)
> constr.dir<-c("<=","<=")
> rhs<-c(60,96)
> prod.sol<-lp("max",obj.fun,constr,constr.dir,rhs,compute.sens=TRUE)
> prod.sol
Success: the objective function is 1000
> prod.sol$solution

[1] 18  8

( Compare the Result manually) 
------------------------------------------------------------------------------------------------------------------
                                    NWC 1
------------------------------------------------------------------------------------------------------------------
#include<conio.h>
#include<stdio.h>
main()
{
int c[20][20],i,k,j,m,n,dem[20],sup[20],sum=0,al[20][20];

printf("\nEnter the no of rows & columns:");
scanf("%d%d",&m,&n);

for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
{
al[i][j]=0;
}
}
printf("\nEnter the cost:");
for(i=0;i<m;i++)
{

for(j=0;j<n;j++)
scanf("%d",&c[i][j]);
}
printf("\nEnter the demand:");
for(i=0;i<n;i++)
scanf("%d",&dem[i]);
printf("\nEnter the supply:");
for(i=0;i<m;i++)

scanf("%d",&sup[i]);
printf("\nMatrix:\n\n +");
for(i=0;i<n;i++)
{
printf("------+");
}
printf("\n ");
for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
printf("| %d ",c[i][j]);
printf("| %d \n +",sup[i]);
for(k=0;k<n;k++)
printf("------+");
printf("\n ");
}

for(j=0;j<n;j++)
printf(" %d ",dem[j]);

for(i=0,j=0;(i<m&&j<n);)
{
if(sup[i]<dem[j])
{
sum+=c[i][j]*sup[i];
al[i][j]=sup[i];
dem[j]-=sup[i];

sup[i]=0;
i++;
}
else
if(sup[i]>dem[j])
{
sum+=c[i][j]*dem[j];
al[i][j]=dem[j];
sup[i]-=dem[j];
dem[j]=0;
j++;
}
else
if(sup[i]=dem[j])
{
sum+=c[i][j]*dem[j];
al[i][j]=dem[j];
sup[i]=0;
dem[j]=0;
j++;
i++;
}

}

printf("\n\n Allocation \n +",sum);
for(i=0;i<n;i++)

{

printf("-----+");
}
printf("\n ");
for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
{
printf("| %d ",al[i][j]);
}
printf("|\n +");
for(k=0;k<n;k++)
printf("-----+");
printf("\n ");
}

printf("\n\nfeasible solution = %d",sum);

getch();
}
------------------------------------------------------------------------------------------------------------------
                                     NWC 2
------------------------------------------------------------------------------------------------------------------
#include<conio.h>
#include<stdio.h>
main()
{
int c[20][20],i,k,j,m,n,dem[20],sup[20],sum=0,al[20][20];
printf("\nEnter the no of rows & columns:");
scanf("%d%d",&m,&n);
for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
{
al[i][j]=0;
}
}
printf("\nEnter the cost:");
for(i=0;i<m;i++)
{

for(j=0;j<n;j++)
scanf("%d",&c[i][j]);
}
printf("\nEnter the demand:");
for(i=0;i<n;i++)
scanf("%d",&dem[i]);
printf("\nEnter the supply:");
for(i=0;i<m;i++)
scanf("%d",&sup[i]);
printf("\nMatrix:\n\n +");
for(i=0;i<n;i++)
{
printf("------+");
}
printf("\n ");
for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
printf("| %d ",c[i][j]);
printf("| %d \n +",sup[i]);
for(k=0;k<n;k++)
printf("------+");
printf("\n ");
}
for(j=0;j<n;j++)
printf(" %d ",dem[j]);
for(i=0,j=0;(i<m&&j<n);)
{
if(sup[i]<dem[j])
{
sum+=c[i][j]*sup[i];
al[i][j]=sup[i];
dem[j]-=sup[i];
sup[i]=0;
i++;
}

else
if(sup[i]>dem[j])
{
sum+=c[i][j]*dem[j];
al[i][j]=dem[j];
sup[i]-=dem[j];
dem[j]=0;
j++;
}
else
if(sup[i]=dem[j])
{
sum+=c[i][j]*dem[j];
al[i][j]=dem[j];
sup[i]=0;
dem[j]=0;
j++;
i++;
}
}
printf("\n\n Allocation \n +",sum);
for(i=0;i<n;i++)
{

printf("-----+");
}
printf("\n ");
for(i=0;i<m;i++)
{
for(j=0;j<n;j++)
{
printf("| %d ",al[i][j]);
}
printf("|\n +");
for(k=0;k<n;k++)
printf("-----+");
printf("\n ");
}
printf("\n\nfeasible solution = %d",sum);
getch();
}
