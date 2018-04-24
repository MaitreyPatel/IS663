import java.util.*;
import java.util.Scanner;
import java.io.File;
public class Main{
	public Main(){
	}
	public static void main(String args[]){
		Scanner key=new Scanner(System.in);
		int n=key.nextInt();
		Main sol=new Main();
		int ans=sol.sum(n);
		System.out.println(ans);
	}
	//method written by student

	public int sum(int n){
	//TODO
return n*n;
}
}