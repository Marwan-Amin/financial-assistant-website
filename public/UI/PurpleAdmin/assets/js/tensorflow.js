async function getData() {
    const balanceDataReq = await fetch(route); 
    
    const balanceData = await balanceDataReq.json(); 
    console.log(balanceData)

    balanceData.forEach(function(row){
        row.totalExpenses = Number(row.totalExpenses);
        row.totalIncome = Number(row.totalIncome)
    }) 
    console.log(balanceData)

    return balanceData;
  }

  async function run() {
    const data = await getData();
    const values = data.map(d => ({
      x: d.balance,
      y: d.totalExpenses,
      
    }));

    tfvis.render.scatterplot(
      {name: 'Balance v totalExpenses'},
      {values}, 
      {
        xLabel: 'Balance',
        yLabel: 'totalExpenses',
        height: 100
      }
    );

    const model = createModel();  
tfvis.show.modelSummary({name: 'Model Summary'}, model);

// Convert the data to a form we can use for training.
const tensorData = convertToTensor(data);
const {inputs, labels} = tensorData;

// Train the model  
await trainModel(model, inputs, labels);
console.log('Done Training');

// Make some predictions using the model and compare them to the
// original data
testModel(model, data, tensorData);
  
  }
  
  document.addEventListener('DOMContentLoaded', run);

  function createModel() {
    // Create a sequential model
    const model = tf.sequential(); 
    
    // Add a single hidden layer
    model.add(tf.layers.dense({inputShape: [1], units: 1, useBias: true}));
    
    // Add an output layer
    model.add(tf.layers.dense({units: 1, useBias: true}));
  
    return model;
  }

  /**
 * Convert the input data to tensors that we can use for machine 
 * learning. We will also do the important best practices of _shuffling_
 * the data and _normalizing_ the data
 * MPG on the y-axis.
 */
function convertToTensor(data) {
    // Wrapping these calculations in a tidy will dispose any 
    // intermediate tensors.
    
    return tf.tidy(() => {
      // Step 1. Shuffle the data    
      tf.util.shuffle(data);
  
      // Step 2. Convert data to Tensor
      const inputs = data.map(d => d.totalExpenses)
      const labels = data.map(d => d.balance);
  
      const inputTensor = tf.tensor2d(inputs, [inputs.length, 1]);
      const labelTensor = tf.tensor2d(labels, [labels.length, 1]);
  
      //Step 3. Normalize the data to the range 0 - 1 using min-max scaling
      const inputMax = inputTensor.max();
      const inputMin = inputTensor.min();  
      const labelMax = labelTensor.max();
      const labelMin = labelTensor.min();
      
      // console.log(inputMax,inputMin,labelMin,labelMax);
      
      const normalizedInputs = inputTensor.sub(inputMin).div(inputMax.sub(inputMin));
      const normalizedLabels = labelTensor.sub(labelMin).div(labelMax.sub(labelMin));
      
      // console.log(inputMax,inputMin,labelMin,labelMax);

      return {
        inputs: normalizedInputs,
        labels: normalizedLabels,
        inputMax,
        inputMin,
        labelMax,
        labelMin,
      }
    });  
  }

  async function trainModel(model, inputs, labels) {
    // Prepare the model for training.  
    model.compile({
      optimizer: tf.train.adam(),
      loss: tf.losses.meanSquaredError,
      metrics: ['mse'],
    });
    
    const batchSize = 32;
    const epochs = 50;
    
    return await model.fit(inputs, labels, {
      batchSize,
      epochs,
      shuffle: true,
      callbacks: tfvis.show.fitCallbacks(
        { name: 'Training Performance' },
        ['loss', 'mse'], 
        { height: 200, callbacks: ['onEpochEnd'] }
      )
    });
  }
  

  function testModel(model, inputData, normalizationData) {
    const {inputMax, inputMin, labelMin, labelMax} = normalizationData;  
    
    // Generate predictions for a uniform range of numbers between 0 and 1;
    // We un-normalize the data by doing the inverse of the min-max scaling 
    // that we did earlier.
    const [xs, preds] = tf.tidy(() => {
      
      const xs = tf.linspace(0, 1, 100);      
      const preds = model.predict(xs.reshape([100, 1]));      
      
      const unNormXs = xs
        .mul(inputMax.sub(inputMin))
        .add(inputMin);
      
      const unNormPreds = preds
        .mul(labelMax.sub(labelMin))
        .add(labelMin);
      
      // Un-normalize the data
      return [unNormXs.dataSync(), unNormPreds.dataSync()];
    });
    
   
    const predictedPoints = Array.from(xs).map((val, i) => {
      return {x: val, y: preds[i]}
    });
    
    const originalPoints = inputData.map(d => ({
      x: d.totalExpenses, y: d.balance,
    }));
    console.log(predictedPoints);

    sendPrediction(originalPoints,predictedPoints);

    tfvis.render.scatterplot(
      {name: 'Model Predictions vs Original Data'}, 
      {values: [originalPoints, predictedPoints], series: ['original', 'predicted']}, 
      {
        xLabel: 'totalExpenses',
        yLabel: 'Balance',
        height: 300
      }
    );
  }

  function sendPrediction(original,predicted){
    $.ajax({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
    type: 'POST',
     url:userPrediction,
     data:{predicted,original},
         success:function(response){
          console.log(response);
         }
      });  
    }