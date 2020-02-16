let oldValue;
document.getElementById('checkInput').addEventListener('input',function(){
 this.setAttribute('min',0.25);
 this.setAttribute('max',99999999999);
    if(this.nodeValue.length > 11){
     
 }
 oldValue=this.value;
});