function toggleClassOnClick(buttonSelector) {
    // Get the button element
    var button = document.querySelector(buttonSelector);

    // Check if the button exists
    if (button) {
        // Add click event listener to the button
        button.addEventListener('click', function() {
            // Get the target element ID from the button's data-target attribute
            var targetId = button.getAttribute('data-target');
            
            // Get the target element
            var targetElement = document.getElementById(targetId);
            
            // Get the class to toggle from the button's data-class attribute
            var toggleClass = button.getAttribute('data-class');
            
            // Check if the target element exists
            if (targetElement) {
                // Toggle the specified class on the target element
                targetElement.classList.toggle(toggleClass);
            } else {
                console.error('Target element with ID ' + targetId + ' not found.');
            }
        });
    } else {
        console.error('Button with selector ' + buttonSelector + ' not found.');
    }
}


        // Get all hidden elements with the 'tw-c' tag
        const hiddenElements = document.querySelectorAll("tw-c");

        // Iterate through each hidden element
        hiddenElements.forEach((hiddenElement) => {
          // Get the data-id attribute value
          const id = hiddenElement.dataset.id;

          // Get all visible elements with the corresponding data-component attribute
          const visibleElements = document.querySelectorAll(
            `[data-component="${id}"]`
          );

          // Apply Tailwind CSS classes to visible elements
          visibleElements.forEach((visibleElement) => {
            const classes = hiddenElement.classList;
            classes.forEach((className) => {
              visibleElement.classList.add(className);
            });
          });
        });