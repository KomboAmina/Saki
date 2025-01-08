countUp();

function countUp(){

    var targetElements=document.getElementsByClassName('count-up');

    for(var e=0; e<targetElements.length; e++){

        let currentElement=targetElements[e];

        let targetid=currentElement.getAttribute('id');
        
        currentElement=document.getElementById(targetid);

        let perc=parseInt(targetElements[e].getAttribute('data-to'));

        let current=0;

        setInterval(()=>{

            if(current<=perc){

                currentElement.innerHTML=current;

                current++;

            }

        },1);

      

    }

}
