
function fibo(num){
    let a=0, b =1;
    let fib = [];  
    for (let index = 0; index < num; index++) {
        if(index == 0 || index == 1){
            fib[index] = 1;
            divisores(fib[index]);
        }else{
            fib[index] = fib[index-1]+ fib[index-2];
            divisores(fib[index]);
        } 
    }
}

fibo(1000);
function divisores(number){
    //console.log(number);
    count = 0;
    for (let index = 0; index < number; index++) {
        if(number%index ===0){
            count++;
        }
    }
    if(count>100){
        console.log(number);
    }
}