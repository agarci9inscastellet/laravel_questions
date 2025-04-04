document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
    // Load Tailwind CSS dynamically
    const redirectDelay = 1000;
    const tailwindLink = document.createElement('link');
    tailwindLink.rel = 'stylesheet';
    tailwindLink.href = 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css'; // Tailwind CSS CDN
    document.head.appendChild(tailwindLink);

    // Select all elements with a 'q' attribute
    const questions = document.querySelectorAll('[question]');
    const qinfos = document.querySelectorAll('[q-info]');

    //const API_URI = 'http://localhost:8000/api/';
    const API_URI = 'https://castelletm12b.cat/api/';

    // Dynamically create the popup HTML
    const popup = document.createElement('div');
    popup.id = 'popup';
    popup.className = 'hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center';
    popup.innerHTML = `
    <style>
        #loader {  
        /* display: none;  hidden by default */  
            border: 16px solid #f3f3f3; /* Light grey */  
            border-top: 16px solid #3498db; /* Blue */  
            border-radius: 50%;  
            width: 50px;  
            height: 50px;  
            animation: spin 2s linear infinite; /* Spin animation */  
        }  

        @keyframes spin {  
            0% { transform: rotate(0deg); }  
            100% { transform: rotate(360deg); }  
        }  
        </style>
        <div id="popupContent" class="bg-white p-6 m-100 rounded shadow-lg text-center" style="max-width:80%">
            <p id="popupText" class="text-lg font-semibold mb-4"></p>
            <div id="loader" class="mx-auto"></div>  

            <form id="popupForm" class="mt-4">
                <img id="popupImg" class="popupImg mx-auto" src="" style="max-width:300px" alt="">
                <input type="text" id="popupInput" class="border border-gray-300 rounded px-4 py-2 w-full mb-4 " placeholder="Enter your response" />
                <div class="flex justify-center gap-4 m-10">
                    <button id="submitPopup" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                    <button id="closePopup" type="button" class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                </div>
            </form>
        </div>
    `;
    document.body.appendChild(popup);



    // Select dynamically created elements
    const popupText = document.getElementById('popupText');
    const popupForm = document.getElementById('popupForm');
    const popupInput = document.getElementById('popupInput');
    const closePopup = document.getElementById('closePopup');
    const popupContent = document.getElementById('popupContent');
    const submitPopup = document.getElementById('submitPopup');
    const popupImg = document.getElementById('popupImg');
    const loader = document.getElementById('loader');

    // Add click event listener to all elements with a 'q' attribute
    questions.forEach((question) => {
        question.addEventListener('click', () => {
            popup.classList.remove('hidden'); // Show the popup
            popupText.textContent = 'Loading...'; // Set the popup text
            popupInput.style.display = 'none';
            submitPopup.style.display = 'none';
            popupImg.style.display = 'none';
            loader.style.display = '';


            const qValue = question.getAttribute('question'); // Get the 'q' attribute value
            if (qValue) {
                // Fetch the text from question.html with the 'q' parameter
                fetch(API_URI + `getquestion/${qValue}`)
                    .then(response => response.json())
                    .then(data => {
                        loader.style.display = 'none';

                        if (data.question) { // Check if the response contains a true value
                            popupText.textContent = data.question; // Set the popup text
                            popup.classList.remove('hidden'); // Show the popup
                            popupContent.className = 'bg-white p-6 m-2 rounded shadow-lg text-center'; // Reset background color
                        } else {
                            console.error('Text not found in the response.');
                        }
                        if (data.info){
                            popupInput.style.display = 'none';
                            submitPopup.style.display = 'none';
                            image = data.info;
                            if (true){
                                
                                popupImg.style.display = '';
                                popupImg.setAttribute('src',data.info);
                            }
                            else{
                                popupImg.style.display = 'none';
                                popupImg.setAttribute('src',"");

                            }
                        }
                        else{
                            popupInput.style.display = '';
                            submitPopup.style.display = '';
                            popupImg.setAttribute('src',"");
                            popupImg.style.display = 'none';

                        }
                    })
                    .catch(error => console.error('Error fetching the text:', error));
            }

            // Handle form submission
            popupForm.addEventListener('submit', (event) => {
                event.preventDefault(); // Prevent the default form submission
                const userInput = popupInput.value.trim();

                if (userInput) {
                    // Fetch the response from answer.html with the 'r' parameter
                    popupContent.className = 'bg-white p-6 m-2 rounded shadow-lg text-center'; // Set background to green

                    fetch(API_URI + `checkanswer/${qValue}/${userInput}`)
                        .then(response => response.json()) // Parse the response as JSON
                        .then(data => {
                            if (data.result) { // Check if the response contains a true value
                                popupText.textContent = "Resposta correcte!!!"; // Show success message
                                popupContent.className = 'bg-green-200 p-6 m-2 rounded shadow-lg text-center'; // Set background to green
                                let href = data.url;
                                setTimeout(() => {
                                    if (href) {
                                        window.location.href = href; // Redirect to the href value after delay
                                    }
                                }, redirectDelay); // Delay of 2 seconds
                            } else {
                                popupText.textContent = "No és correcte!!"; // Update the popup text
                                popupContent.className = 'bg-red-400 p-6 m-2 rounded shadow-lg text-center'; // Set background to red
                            }
                        })
                        .catch(error => console.error('Error fetching the response:', error));
                } 
            });
        });
    });

    closePopup.addEventListener('click', () => {
        popupInput.value = "";
        popup.classList.add('hidden'); // Hide the popup
    });



    // // Add click event listener to all elements with a 'q-info' attribute
    // let n=0;
    // qinfos.forEach((qinfo) => {
    //     n++;

    //     const targetId = qinfo.getAttribute('q-info'); // Get the target element's ID
    //     const targetElement = document.getElementById(targetId); // Find the target element

    //     // Dynamically create an <a-plane> element
    //     const aPlane = document.createElement('a-plane');
    //     aPlane.setAttribute('id', `q-${targetId}`); // Set the source of the image

    //     aPlane.setAttribute('src', `#${targetId}`); // Set the source of the image
    //       pos="" + qinfo.getAttribute("position").x+" "+qinfo.getAttribute("position").y +" "+(qinfo.getAttribute("position").z - 0.1).toString()
    //    // aPlane.setAttribute('position', pos); // Example position
    //     aPlane.setAttribute('position',pos);
    //     aPlane.setAttribute('width', '2'); // Example width
    //     aPlane.setAttribute('height', '2'); // Example height
    //     aPlane.setAttribute('visible', true); // Initially hidden
    //     aPlane.setAttribute('rotate-with-camera', true); // Initially hidden
    //     aPlane.setAttribute('look-at',"#camera"); // Initially hidden
    //     document.getElementById(targetId); 
    //     const scene = document.getElementsByTagName("a-scene")[0];
    //     scene.appendChild(aPlane); // Append the <a-plane> to the body
    //    // aPlane.setAttribute('position', "1 1 1"); // Example position
    //     qinfo.addEvent--Listener("click",(event) => {
    //         selector  = event.target.getAttribute("q-info");
    //         const targetElement = document.getElementById("q-"+selector);

    //         targetElement.setAttribute('visible',true);
    //         event.target.setAttribute('visible',false);
    //     });

    //     aPlane.addEventListener('click', (event) => {
    //         event.target.setAttribute('visible', false); // Hide the <a-plane>
    //         qinfos.forEach((qinfo) => {
    //             qinfo.setAttribute('visible', true);
    //         });
    //         // if (event.target.getAttribute('visible') === true) {
    //         //     event.target.setAttribute('visible', false); // Hide the <a-plane>
    //         // } else {
    //         //     event.target.setAttribute('visible', true); // Show the <a-plane>
    //         // }
    //     });
    // });
},500)
});

function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    //http.send();
    http.onreadystatechange = function() {
        if (http.readyState === 4) {
          return (http.status === 200);
        }
        return false;
      };


}