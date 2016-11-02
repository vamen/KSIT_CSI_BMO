 #include<iostream>
 using namespace std;
 class Demosuper
 {
 	protected:
 		Demo obj*;
 		int val;
  		Demo(){
 			cout<<"constructer called\n";
                  }
 	public:
 		Demo(int n,Demosuper cobj)
                 {   
                     obj=new Demo(); 
                     val=n;
                 }
 		void print()
 			{
 				cout<<"Value : "<<val<<endl;
 			}
 };
 int main()
 {
 
  Demo obj2;
  Demo obj1(10,obj); 
  cout<<obj1.val;
  cout<<obj2.val;
 }

