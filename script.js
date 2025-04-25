let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();

console.log("Gratitude Journal is ready!");
const entryText = document.getElementById("entry");
const categorySelect = document.getElementById("category");
const entriesList = document.getElementById("entriesList");
const form = document.querySelector("#entries form");
const calendarContainer = document.getElementById("calendarContainer");



let currentSlide = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove("active");
        if (i === index) {
            slide.classList.add("active");
        }
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length; // Loop back to the first slide
    showSlide(currentSlide);
}

// Automatically change slides every 3 seconds
setInterval(nextSlide, 3000);

// Show the first slide on load
showSlide(currentSlide);





// Load saved entries from local storage
function loadEntries() {
    const entries = JSON.parse(localStorage.getItem("gratitudeEntries")) || [];
    entriesList.innerHTML = "";
    entries.forEach((entry, index) => {
        const li = document.createElement("li");
        li.textContent = `${entry.text} (${entry.category})`;
        li.appendChild(createDeleteButton(index));
        entriesList.appendChild(li);
    });
}

// Save a new entry
function saveEntry(event) {
    event.preventDefault();
    const text = entryText.value.trim();
    const category = categorySelect.value;

    if (text === "") {
        alert("Please write something you're grateful for!");
        return;
    }

    const today = new Date();
    const formattedDate = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, "0")}-${String(today.getDate()).padStart(2, "0")}`;

    const entries = JSON.parse(localStorage.getItem("gratitudeEntries")) || [];
    entries.push({ text, category, date: formattedDate });
    localStorage.setItem("gratitudeEntries", JSON.stringify(entries));

    entryText.value = "";
    categorySelect.value = "family";
    loadEntries();
}

// Create a delete button for each entry
function createDeleteButton(index) {
    const button = document.createElement("button");
    button.textContent = "Delete";
    button.style.marginLeft = "10px";
    button.onclick = () => deleteEntry(index);
    return button;
}

// Delete an entry
function deleteEntry(index) {
    const entries = JSON.parse(localStorage.getItem("gratitudeEntries")) || [];
    entries.splice(index, 1);
    localStorage.setItem("gratitudeEntries", JSON.stringify(entries));
    loadEntries();
}

// Attach event listener to the form
form.addEventListener("submit", saveEntry);

function generateCalendar(year = currentYear, month = currentMonth) {
    const today = new Date();
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    // Update the month and year in the header
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    document.getElementById("currentMonthYear").textContent = `${monthNames[month]} ${year}`;

    // Clear the calendar
    calendarContainer.innerHTML = "";

    // Add empty divs for days before the first day
    for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement("div");
        calendarContainer.appendChild(emptyDiv);
    }

    // Add days of the month
    for (let date = 1; date <= lastDate; date++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = date;

        // Highlight the current day if it matches
        if (year === today.getFullYear() && month === today.getMonth() && date === today.getDate()) {
            dayDiv.classList.add("current-day");
        }

        // Add click event for showing entries
        dayDiv.addEventListener("click", () => {
            document.querySelectorAll("#calendarContainer div").forEach(div => {
                div.classList.remove("selected");
            });

            dayDiv.classList.add("selected");
            showEntriesForDate(year, month, date);
        });

        calendarContainer.appendChild(dayDiv);
    }
}

// Add navigation button event listeners 
document.getElementById("prevMonth").addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11; // Go to December of the previous year
        currentYear--;
    }
    generateCalendar(currentYear, currentMonth);
});

document.getElementById("nextMonth").addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0; // Go to January of the next year
        currentYear++;
    }
    generateCalendar(currentYear, currentMonth);
});

        
       
    



// Show entries for a specific date
function showEntriesForDate(year, month, date) {
    const entries = JSON.parse(localStorage.getItem("gratitudeEntries")) || [];
    const formattedDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(date).padStart(2, "0")}`;

    const entriesForDate = entries.filter(entry => entry.date === formattedDate);

    const selectedDateContainer = document.getElementById("selectedDateEntries");
    const selectedDateSpan = document.getElementById("selectedDate");
    const entriesForDateList = document.getElementById("entriesForDateList");

    selectedDateSpan.textContent = formattedDate;
    entriesForDateList.innerHTML = "";

    if (entriesForDate.length === 0) {
        const noEntriesItem = document.createElement("li");
        noEntriesItem.textContent = "No entries found for this date.";
        entriesForDateList.appendChild(noEntriesItem);
    } else {
        entriesForDate.forEach(entry => {
            const entryItem = document.createElement("li");
            entryItem.textContent = `${entry.text} (${entry.category})`;
            entriesForDateList.appendChild(entryItem);
        });
    }

    selectedDateContainer.style.display = "block";

    document.getElementById("closeSelectedDateEntries").addEventListener("click", () => {
        selectedDateContainer.style.display = "none";
        document.querySelectorAll("#calendarContainer div").forEach(div => {
            div.classList.remove("selected");
        });
    });
}

function generateCategoryAnalysis() {
    const entries = JSON.parse(localStorage.getItem("gratitudeEntries")) || [];
    const categoryCounts = {};

    // Count entries for each category
    entries.forEach(entry => {
        categoryCounts[entry.category] = (categoryCounts[entry.category] || 0) + 1;
    });

    // Populate the category list
    const categoryList = document.getElementById("categoryList");
    categoryList.innerHTML = ""; // Clear previous data

    for (const category in categoryCounts) {
        const li = document.createElement("li");
        li.textContent = `${category}: ${categoryCounts[category]} entries`;
        categoryList.appendChild(li);
    }
}



// Load entries and generate calendar on page load
loadEntries();
generateCalendar();


generateCategoryAnalysis();
