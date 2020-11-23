function palindromo(){
    let cadena="afoolishconsistencyisthehobgoblinoflittlemindsadoredbylittlestatesmenandphilosophersanddivineswithconsistencyagreatsoulhassimplynothingtodohemayaswellconcernhimselfwithhisshadowonthewallspeakwhatyouthinknowinhardwordsandtomorrowspeakwhattomorrowthinksinhardwordsagainthoughitcontradicteverythingyousaidtodayahsoyoushallbesuretobemisunderstoodisitsobadthentobemisunderstoodpythagoraswasmisunderstoodandsocratesandjesusandlutherandcopernicusandgalileoandnewtonandeverypureandwisespiritthatevertookfleshtobegreatistobemisunderstood";
    let temp= '';
    
    console.log(temp);
            temp = cadena.match(/.{1,4}/g)
        if(temp.length > 1){
            FindPalindrome(temp);
        }
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
