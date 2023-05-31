let prompt_in = '';

document.addEventListener('DOMContentLoaded', () => {
  const submitButton = document.querySelector('#submit_button');
  submitButton.addEventListener('click', handleFormSubmit);
});

function handleFormSubmit(e) {
  e.preventDefault();

  console.log("呼び出し");

  prompt_in = document.querySelector('#text').value;

  console.log(prompt_in);

  const sendData = {
    prompt: prompt_in
  };

  fetch('http://localhost:8090/test', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': getCSRFToken()
    },
    body: JSON.stringify(sendData)
  })
    .then(response => response.json())
    .then(handleResponse)
    .catch(handleError);
}

function handleResponse(data) {
  console.log("呼び出し");

  if (data.status === "success") {
    console.log(data.response);

    const outgoingMessage = createMessageHTML("outgoing", prompt_in);
    const incomingMessage = createMessageHTML("incoming", data.response);

    appendMessage(outgoingMessage);
    appendMessage(incomingMessage);

    console.log("成功");
  }
}

function createMessageHTML(className, message) {
  return `
    <div class="message ${className}">
      <div>
        ${className === "incoming" ? '<img class="user-photo" src="sozai-rei-yumesaki-hyokkori-1.png">' : ''}
      </div>
      <div class="message-body">
        <p>${message}</p>
      </div>
    </div>
  `;
}

function appendMessage(messageHTML) {
  const addTag = document.querySelector('#add_tag');
  addTag.insertAdjacentHTML('beforeend', messageHTML);
}

function handleError(error) {
  console.error('Error:', error);
}

function getCSRFToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}
