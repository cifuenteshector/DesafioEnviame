function palindromo(){
    let cadena="afoolishconsistencyisthehobgoblinoflittlemindsadoredbylittlestatesmenandphilosophersanddivineswithconsistencyagreatsoulhassimplynothingtodohemayaswellconcernhimselfwithhisshadowonthewallspeakwhatyouthinknowinhardwordsandtomorrowspeakwhattomorrowthinksinhardwordsagainthoughitcontradicteverythingyousaidtodayahsoyoushallbesuretobemisunderstoodisitsobadthentobemisunderstoodpythagoraswasmisunderstoodandsocratesandjesusandlutherandcopernicusandgalileoandnewtonandeverypureandwisespiritthatevertookfleshtobegreatistobemisunderstood";
    let temp= '';
    
    console.log(temp);
    //for (let index = 0; 4; index++) {
      //  if(index > 2){
            temp = cadena.match(/.{1,4}/g);
            //temp = cadena.split(/(.{'index'})/).filter(O=>O);
            //console.log(temp);
        //}
    //}
    //     //console.log(temp);
        if(temp.length > 1){
            FindPalindrome(temp);
        }
    //}
}
function FindPalindrome(palabra) {
    palabra.forEach(element => {
        //console.log(element);
        invertida = invertir(element);
        //console.log(invertida);
        if(element === invertida){
            //console.log(invertida);
            return invertida;
        }
    });
}

function invertir(cadena) {
    return cadena.split('').reverse().join('');
}

palindromo();
