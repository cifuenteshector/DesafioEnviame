let step = 100

let rangesArray = [
    {'km':100,'days':0},
    {'km':200,'days':1},
]
for (i=2;i<20;i++){
    const  prevValue = rangesArray[i-1]
    const prevValue2 = rangesArray[i-2]
    const newKM = prevValue['km']+step
    const newDays = prevValue['days'] + prevValue2['days']
    rangesArray.push({'km':  newKM, 'days': newDays})
}
console.log(rangesArray)