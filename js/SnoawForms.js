function HandleForm(why, functionEval) {
  const form = document.querySelectorAll('form');
  let i = 0;
  while(i<form.length){
    let f = i;
    form[f].addEventListener('submit', (e)=>{
      e.preventDefault();
      Swal.fire({
        title: "Confirm Action",
        text: `Are you sure to ${why}?`,
        showCancelButton: true,
        confirmButtonText: "Confirm",
        showLoaderOnConfirm: true,
     }).then((result) => {
        if (result.isConfirmed){
        xhr = new XMLHttpRequest;
          xhr.open(form[f].method, form[f].action);
          xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                eval(xhr.response);
                functionEval && eval(functionEval);
                console.log(data);
                Swal.fire({
                  title: data.title,
                  icon: data.icon,
                  text: data.text,
                });
              }
            }
          }
          const Fields = new FormData(form[f]);
          xhr.send(Fields)
        }
     })
    });
    i++;
  }
}

function DataSubmitter(rMethod, rAction, rData) {
  // Convert data to JSON string
  rData = JSON.stringify(rData);

  // Display loader popup
  Swal.fire({
    title: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="40" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="100" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="160" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>',
    allowOutsideClick: false,
    onBeforeOpen: () => {
      Swal.showLoading();
    }
  });

  // Make XMLHttpRequest
  xhr = new XMLHttpRequest();
  xhr.open(rMethod, rAction);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      // Close loader popup
      Swal.close();

      if (xhr.status >= 200 && xhr.status < 300) {
        // Display success response
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: xhr.response
        });
      } else {
        // Display error response
        displayText = "Something went wrong!";
        message = JSON.parse(xhr.response).message;
        if(message) {
          displayText = message;
        }
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: displayText
        });
      }
    } else {
      alert('request failed');
    }
  };
  xhr.send(rData);
}

function ModelDelete(ModelName, ModelId) {
  if (confirm(`Are you sure you want to delete ${ModelName} ?`)) {
  Swal.fire({
    title: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="40" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="100" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#5675FF" stroke="#5675FF" stroke-width="15" r="15" cx="160" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>',
    allowOutsideClick: false,
    onBeforeOpen: () => {
      Swal.showLoading();
    }
  });
    xhr = new XMLHttpRequest();
    const rAction = `/api/${ModelName}/${ModelId}`;
    xhr.open('DELETE', rAction);
    xhr.setRequestHeader("Content-Type", "application/json"); 
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
      Swal.close();
        if (xhr.status >= 200 && xhr.status < 300) {
          // Display success response
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: xhr.response
          });
        } else {
      Swal.close();
          // Display error response
          displayText = "Something went wrong!";
          message = JSON.parse(xhr.response).message;
          if(message) {
            displayText = message;
          }
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: displayText
          });
        }
      }
    }
  xhr.send();
  }
}


//simple Ibterest Calculator
function calculateTotalAmountPaid(loanAmount, interestRate, loanTermMonths) {
    let monthlyInterestRate = interestRate / 12 / 100;
    let monthlyPayment = loanAmount * monthlyInterestRate / (1 - Math.pow(1 + monthlyInterestRate, -loanTermMonths));
    let totalAmountPaid = monthlyPayment * loanTermMonths;
    totalAmountPaid = Math.round(totalAmountPaid * 100) / 100;
    return totalAmountPaid;
}

function ApproveLoan(ModelId, Term) {
  if(alert('Are you sure, you want to approve this loan!')){
  var startDate = new Date();
  startDate.setDate(startDate.getDate() + 1);
  var endDate = new Date();
  endDate.setMonth(endDate.getMonth() + Term);
  var rData = JSON.stringify({
    status: "approved",
    start_date: startDate.toISOString(),
    end_date: endDate.toISOString()
  });
    xhr = new XMLHttpRequest();
    const rAction = `/api/loans/${ModelId}`;
    xhr.open('PUT', rAction);
    xhr.setRequestHeader("Content-Type", "application/json"); 
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
      Swal.close();
        if (xhr.status >= 200 && xhr.status < 300) {
          // Display success response
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: xhr.response
          });
        } else {
      Swal.close();
          // Display error response
          displayText = "Something went wrong!";
          message = JSON.parse(xhr.response).message;
          if(message) {
            displayText = message;
          }
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: displayText
          });
        }
      }
    }
  xhr.send(rData);
}
  }
