<html>
   
<style>
.topp{
	margin-top:30px;
}
.right{
    margin-left: 115px;
}
</style>
	<body>


		<?php
			require_once 'ORM.php';
			require_once 'main.php';
			require_once 'checksajax.php';
            if(!isset($_SESSION['id'])){
    header("Location:http://localhost/project/php/userlogin.php");
}
if($_SESSION['type']=="user"){
  echo "PERMISSION DENIED ";
  echo "you dont have permission to access this page";

}
else{

		?>
	<div class="container">
        <h2><span class="glyphicon glyphicon-check"></span> Checks</h2>
    	<div class="row">
        	<div class='col-sm-5'>
            	<div class="form-group">
            		<label> From:</label>

                		<div class='input-group date' id='datetimepicker1'>
                	 		<input type='date' id="date1" class="form-control" placeHolder="mm-dd-yyyy" />
                    		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    		</span>
                		</div>
            	</div>
        	</div>
        	<div class='col-sm-5'>
        		<div class="form-group">
            		<label> To:</label>

                		<div class='input-group date' id='datetimepicker1'>
                	 		<input type='date' id="date2" class="form-control" placeHolder="mm-dd-yyyy" />
                    		<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    		</span>
                		</div>
            	</div>
        	</div>
        	<div class='col-sm-2'>
        		<div class="form-group">
        			<input type="submit" class="btn btn-success topp" value="Get checks" onclick="getchecks()">
        		</div>
        	</div>	
      
    	</div>
    	<div class="row">
    		<div id="show">

    			
    		</div>
            <div id="sub-show">
             </div> 
             <div class="container" id="sub-sub">
                    
             </div>  
    	</div>
	</div>
	<script>
	function getchecks()
    {
		var date1=document.getElementById("date1").value;
		var date2=document.getElementById("date2").value;

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() 
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                data=xmlhttp.responseText;
                var div=document.getElementById("show");
                
                 
                
                
               
                var rec=JSON.parse(data);
                if(document.getElementById("tables")){
                    div.removeChild(document.getElementById("tables"));
                     if(document.getElementById("table")){
                         var div1=document.getElementById("sub-show");

                        div1.removeChild(document.getElementById("table"));
                        if(document.getElementById("row")){
                            var div2=document.getElementById("sub-sub");
                    div2.removeChild(document.getElementById("row"));
                        }
                                }
                }
                var table = document.createElement("TABLE");
                table.setAttribute("class","table table-bordered table-hover text-center");
                table.setAttribute("id","tables");

                div.appendChild(table);
                var row = table.insertRow(0);
                var cell1=row.insertCell(0);
                var cell2=row.insertCell(1);
                cell1.innerHTML="USER";
                cell2.innerHTML="PRICES";
                for(i=0;i<rec.users.length;i++)
                {

                    var row = table.insertRow(i+1);
                    var cell1=row.insertCell(0);
                    var cell2=row.insertCell(1);
                    var cell3=row.insertCell(2);
                    plus=document.createElement('button');
                    plus.setAttribute("class","btn btn-default btn-s close");
                    plus.setAttribute("id",rec.id[i]);
                    plus.innerHTML="+";
                
                 
                    cell3.appendChild(plus);
                    cell1.innerHTML=rec.users[i];
                    cell2.innerHTML=rec.prices[i];
               

                    plus.onclick=function()
                    {
                        var div1=document.getElementById("sub-show");
                        var close=document.getElementsByClassName("close");

                        if(this.innerHTML=="-"){
                            this.innerHTML="+";
                            div1.removeChild(document.getElementById("table"));
                        }
                        else
                        {
                         for(m=0;m<close.length;m++){
                            close[m].innerHTML="+";
                        }    
                        this.innerHTML="-";
                        var xmlhttp1 = new XMLHttpRequest();
                        xmlhttp1.onreadystatechange = function()
                        {
                            if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) 
                            {
                                var rec1=JSON.parse(xmlhttp1.responseText);

                                //div1.innerHTML=xmlhttp1.responseText;
                                if(document.getElementById("table")){
                                    div1.removeChild(document.getElementById("table"));
                                     if(document.getElementById("row"))
                                     {
                                        var div2=document.getElementById("sub-sub");
                                div2.removeChild(document.getElementById("row"));
                                    }

                                }
                                

                                var table1 = document.createElement("TABLE");
                                table1.setAttribute("class","table table-bordered table-hover text-center");
                                table1.setAttribute("id","table");
                                table1.style.width="80%";
                                div1.appendChild(table1);
                                var row1 = table1.insertRow(0);
                                var cell11=row1.insertCell(0);
                                var cell21=row1.insertCell(1);
                               
                                cell11.innerHTML="DATE";
                                cell21.innerHTML="PRICE";
                                for(j=0;j<rec1.dates.length;j++)
                                {

                                    var row1 = table1.insertRow(j+1);
                                    var cell11=row1.insertCell(0);
                                    var cell21=row1.insertCell(1);
                                     var cell31=row1.insertCell(2);
                                    plus1=document.createElement('button');
                                    plus1.setAttribute("class","btn btn-default btn-s close1");
                                    plus1.setAttribute("id",rec1.idd[j]);
                                    plus1.innerHTML="+";
                
                 
                                    cell31.appendChild(plus1);
                                    cell11.innerHTML=rec1.dates[j];
                                    cell21.innerHTML=rec1.price[j];

                                    plus1.onclick=function()
                                    {
                                        var div2=document.getElementById("sub-sub");
                                        var close1=document.getElementsByClassName("close1");
                                       
                                        if(this.innerHTML=="-")
                                        {
                                            this.innerHTML="+";
                                            div2.removeChild(document.getElementById("row"));

                                        }
                                        else
                                        { 
                                            for(m1=0;m1<close1.length;m1++){
                                            close1[m1].innerHTML="+";
                                            }
                                        this.innerHTML="-";
                                        
                                        var xmlhttp2 = new XMLHttpRequest();
                                        xmlhttp2.onreadystatechange = function() 
                                        {
                                            if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
                                            {
                                                var rec2=JSON.parse(xmlhttp2.responseText);
                                                if(document.getElementById("row")){
                                                        div2.removeChild(document.getElementById("row"));
                                                    }
                                                    var row=document.createElement("div");
                                                    row.setAttribute("class","row");
                                                    row.setAttribute("id","row");
                                                    div2.appendChild(row);

                                                for(k=0;k<rec2.name.length;k++)

                                                {
                                                    
                                                    var col=document.createElement("div");
                                                    col.setAttribute("id","col");
                                                    col.setAttribute("class","col-md-3");
                                                    row.appendChild(col);
                                                    var img = document.createElement("img");
                                                    img.setAttribute("class","img-circle center-block topp");
                                                    img.style.width="60px";
                                                    img.style.height="60px";
                                                    img.src="../image/"+rec2.images[k];
                                                    col.appendChild(img);
                                                    var name=document.createElement('div');
                                                    name.setAttribute("class","right top");
                                                    col.appendChild(name);


                                                    name.innerHTML=rec2.name[k];
                                                    var price=document.createElement("div");
                                                    price.setAttribute("class","label label-primary right topp");
                                                    col.appendChild(price);
                                                    price.innerHTML=rec2.p[k]+" L.E";
                                                }    
                                                


                                            }
                                        }
                                        }
                                        xmlhttp2.open("GET", "checksajax.php?idd="+this.id, true);
                                        xmlhttp2.send();

                                    }
                               } 


                            }
                        }
                        }
                        
                        xmlhttp1.open("GET", "checksajax2.php?id="+this.id+"&"+"date1="+date1+"&"+"date2="+date2, true);
      
                        xmlhttp1.send();


                    }


               
                }



            }    
        }
        xmlhttp.open("GET", "checksajax.php?date1="+date1+"&"+"date2="+date2, true);
        //xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send();

	}
	</script>


<?php } ?>
	

	</body>
</html>