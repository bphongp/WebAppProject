import { Component } from '@angular/core';
import { User } from './user';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './signup.html',
  styleUrls: ['./signup.css']
})
export class AppComponent {
  title = 'Sign up';


  // let's create a property to store a response from the back end
  // and try binding it back to the view
  responsedata = new User('','', '', '', '', '');

  genders = ['Male', 'Female', 'Prefer Not to Identify'];
  userModel = new User('', '','', '', '', '');
  
  

  constructor(private http: HttpClient) { }

  senddata(data){
    console.log(data);
    let params=JSON.stringify(data)
         //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
         //this.http.post('http://localhost/cs4640s19/ngphp-post.php', data)
    this.http.post<User>('http://localhost/PL/WebAppProject/ngphp-template.php',data)
    .subscribe((data)=>{
      console.log('Got data from backend', data);
      this.responsedata = data;
    },
    (error)=>{
      console.log('Error', error);
    })
  }
}