function getRanges () {
    let step = 100
    let rangesArray = [
      {'km':100,'days':0},
      {'km':200,'days':1},
    ]
    for (i=2;i<20;i++){
      const prevValue = rangesArray[i-1];
      const prevValue2 = rangesArray[i-2];
      const newKm = prevValue['km'] + step;
      const newDays = prevValue['days'] + prevValue2['days'];
      rangesArray.push({'km':  newKm, 'days': newDays});
    }
    return rangesArray;
  }
  
  function estimateTime(km) {
    const ranges = getRanges();
    const estimatedRange = ranges.find((range) => km <= range['km'])
    return estimatedRange['days']
  }
  
  const testArray = [
    Math.floor(Math.random() * 2000),
    Math.floor(Math.random() * 2000),
    Math.floor(Math.random() * 2000)
  ]
  
  for(z=0;z<testArray.length;z++){
    console.log(estimateTime(testArray[z]))
  }