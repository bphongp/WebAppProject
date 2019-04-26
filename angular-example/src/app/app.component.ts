import { Component } from '@angular/core';
import { Order } from './order';

import {HttpClient, HttpErrorResponse, HttpParams} from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'CS4640 - inclass12';
  drinks = ['Coffee', 'Tea', 'Milk'];
  responsedata = new Order('', '',0 ,'','',true)
  orderModel = new Order('', 'duh@uva.edu', 9991234567, '', '', true);
  constructor(private http: HttpClient){}


  senddata(data){
    console.log(data);
    let params=JSON.stringify(data)
         //this.http.get('http://localhost/cs4640s19/ngphp-get.php?str='+encodeURIComponent(params))
         //this.http.post('http://localhost/cs4640s19/ngphp-post.php', data)
    this.http.get<Order>('http://localhost/PL/WebAppProject/ngphp-template.php?str='+params)
    .subscribe((data)=>{
      console.log('Got data from backend', data);
      this.responsedata = data;
    },
    (error)=>{
      console.log('Error', error);
    })
  }
}