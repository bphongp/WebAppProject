import { Component } from '@angular/core';
import { User } from './user';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Sign up';


  // let's create a property to store a response from the back end
  // and try binding it back to the view
  responsedata = new User('','', '', '', '');

  genders = ['Male', 'Female', 'Prefer Not to identify'];
  userModel = new User('hi', 'hi','hihi', 'hihi', 'Male');
  
  

  constructor(private http: HttpClient) { }

  senddata(data){
    console.log(data);
    let params=JSON.stringify(data)
         //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
         //this.http.post('http://localhost/cs4640s19/ngphp-post.php', data)
    this.http.get<User>('http://localhost/PL/WebAppProject/ngphp-template.php?str='+params)
    .subscribe((data)=>{
      console.log('Got data from backend', data);
      this.responsedata = data;
    },
    (error)=>{
      console.log('Error', error);
    })
  }
}