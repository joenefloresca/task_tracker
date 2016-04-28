<style>
/* 
Generic Styling, for Desktops/Laptops 
*/
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #eee; 
}
th { 
  background: #333; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: left; 
}
</style>

<h2>Tasks Report of {{$name}} </h2>
<p>Date Submitted: {{$date}}</p>
<br/>
{!!$body!!}
<br/>
<p>Submitted By:</p>
<p>{{$name}}</p>