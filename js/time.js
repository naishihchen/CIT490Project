function getTime() {
    
    var months = [" ", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    var date = new Date();
    
    var year = date.getFullYear();

    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    
    var monthNum = parseInt(month)

    var day = ("0" + date.getDate()).slice(-2);
    
    var dayNum = parseInt(day) % 7;
 
    var date_string ="Last Updated: " + day + " " + months[monthNum] + " , " + year;
    
    //alert(dayNum);
    
    document.getElementById("updated").innerHTML = date_string;
}