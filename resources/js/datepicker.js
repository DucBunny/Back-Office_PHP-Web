export class DatePicker {
    constructor() {
        this.input = document.getElementById("datePicker");
        this.dropdown = document.getElementById("dateDropdown");
        this.monthYear = document.getElementById("dateMonthYear");
        this.grid = document.getElementById("dateGrid");
        this.prevBtn = document.getElementById("datePrev");
        this.nextBtn = document.getElementById("dateNext");
        this.selectedDate = null;
        this.today = new Date();
        this.currentMonth = this.today.getMonth();
        this.currentYear = this.today.getFullYear();
        this.maxYear = this.today.getFullYear();
        this.minYear = 1900;
        this.mode = "day"; // 'day', 'month', 'year'
        this.init();
    }

    init() {
        this.input.addEventListener("click", (e) => {
            e.stopPropagation();
            this.showDropdown();
        });

        this.prevBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (this.mode === "day") {
                if (this.currentMonth === 0) {
                    if (this.currentYear > this.minYear) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    }
                } else {
                    this.currentMonth--;
                }
            } else if (this.mode === "month") {
                if (this.currentYear > this.minYear) {
                    this.currentYear--;
                }
            } else if (this.mode === "year") {
                this.yearPageStart -= 20;
                this.yearPageStart =
                    this.yearPageStart < this.minYear
                        ? this.minYear
                        : this.yearPageStart;
            }
            this.render();
        });

        this.nextBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (this.mode === "day") {
                if (this.currentMonth === 11) {
                    if (this.currentYear < this.maxYear) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    }
                } else {
                    this.currentMonth++;
                }
            } else if (this.mode === "month") {
                if (this.currentYear < this.maxYear) {
                    this.currentYear++;
                }
            } else if (this.mode === "year") {
                this.yearPageStart += 20;
                this.yearPageStart =
                    this.yearPageStart > this.maxYear - 19
                        ? this.maxYear - 19
                        : this.yearPageStart;
            }
            this.render();
        });

        this.monthYear.addEventListener("click", (e) => {
            e.stopPropagation();
            if (this.mode === "day") {
                this.mode = "month";
            } else if (this.mode === "month") {
                this.mode = "year";
                this.yearPageStart = this.currentYear - 19;
            }
            this.render();
        });

        document.addEventListener("click", (e) => {
            if (
                !this.dropdown.contains(e.target) &&
                !this.input.contains(e.target)
            ) {
                this.hideDropdown();
            }
        });

        this.dropdown.addEventListener("click", (e) => {
            e.stopPropagation();
        });

        this.render();
    }

    showDropdown() {
        this.dropdown.style.display = "block";
        this.mode = "day";
        this.render();
        this.input.closest(".position-relative").style.position = "relative";
    }

    hideDropdown() {
        this.dropdown.style.display = "none";
    }

    render() {
        const monthNames = [
            "Th1",
            "Th2",
            "Th3",
            "Th4",
            "Th5",
            "Th6",
            "Th7",
            "Th8",
            "Th9",
            "Th10",
            "Th11",
            "Th12",
        ];

        if (this.mode === "day") {
            this.monthYear.innerHTML = `<span style="cursor:pointer">${
                monthNames[this.currentMonth]
            }</span> <span style="cursor:pointer">${this.currentYear}</span>`;
            this.grid.innerHTML = "";
            // Đảm bảo grid có 7 cột cho ngày trong tuần
            this.grid.style.display = "grid";
            this.grid.style.gridTemplateColumns = "repeat(7, 1fr)";
            // Render day names
            const dayNames = ["CN", "T2", "T3", "T4", "T5", "T6", "T7"];
            dayNames.forEach((d) => {
                const el = document.createElement("div");
                el.textContent = d;
                el.style.fontWeight = "bold";
                el.style.background = "#f8f9fa";
                el.style.borderRadius = "4px";
                el.style.textAlign = "center";
                this.grid.appendChild(el);
            });
            // Days in month
            const firstDay = new Date(
                this.currentYear,
                this.currentMonth,
                1
            ).getDay();
            const daysInMonth = new Date(
                this.currentYear,
                this.currentMonth + 1,
                0
            ).getDate();
            let day = 1;
            for (let i = 0; i < 42; i++) {
                const cell = document.createElement("div");
                cell.className = "date-day";
                if (i >= firstDay && day <= daysInMonth) {
                    cell.textContent = day;
                    const cellDate = new Date(
                        this.currentYear,
                        this.currentMonth,
                        day
                    );
                    // Disable future dates
                    if (cellDate > this.today) {
                        cell.classList.add("disabled");
                    } else {
                        if (
                            this.selectedDate &&
                            this.isSameDate(cellDate, this.selectedDate)
                        ) {
                            cell.classList.add("selected");
                        }
                        if (this.isSameDate(cellDate, this.today)) {
                            cell.classList.add("today");
                        }
                        cell.addEventListener("click", (e) => {
                            e.stopPropagation();
                            this.selectDate(cellDate);
                        });
                    }
                    day++;
                } else {
                    cell.classList.add("disabled");
                    cell.textContent = "";
                }
                this.grid.appendChild(cell);
            }
        } else if (this.mode === "month") {
            this.monthYear.innerHTML = `<span style="cursor:pointer">${this.currentYear}</span>`;
            this.grid.innerHTML = "";
            // 2 dòng, mỗi dòng 6 tháng
            for (let row = 0; row < 2; row++) {
                for (let col = 0; col < 6; col++) {
                    let i = row * 6 + col;
                    const cell = document.createElement("div");
                    cell.className = "date-day";
                    cell.textContent = monthNames[i];
                    if (i === this.currentMonth) {
                        cell.classList.add("selected");
                    }
                    cell.addEventListener("click", (e) => {
                        e.stopPropagation();
                        this.currentMonth = i;
                        this.mode = "day";
                        this.render();
                    });
                    this.grid.appendChild(cell);
                }
            }
            // Cập nhật grid style cho 6 cột
            this.grid.style.display = "grid";
            this.grid.style.gridTemplateColumns = "repeat(6, 1fr)";
        } else if (this.mode === "year") {
            if (this.yearPageStart === undefined) {
                this.yearPageStart = this.currentYear - (this.currentYear % 20);
            }
            this.monthYear.innerHTML = `<span style="cursor:pointer">${
                this.yearPageStart
            } - ${this.yearPageStart + 19}</span>`;
            this.grid.innerHTML = "";
            // 4 dòng, mỗi dòng 5 năm
            for (let row = 0; row < 4; row++) {
                for (let col = 0; col < 5; col++) {
                    let i = row * 5 + col;
                    const year = this.yearPageStart + i;
                    const cell = document.createElement("div");
                    cell.className = "date-day";
                    cell.textContent = year;
                    if (year === this.currentYear) {
                        cell.classList.add("selected");
                    }
                    cell.addEventListener("click", (e) => {
                        e.stopPropagation();
                        this.currentYear = year;
                        this.mode = "month";
                        this.render();
                    });
                    this.grid.appendChild(cell);
                }
            }
            // Cập nhật grid style cho 5 cột
            this.grid.style.display = "grid";
            this.grid.style.gridTemplateColumns = "repeat(5, 1fr)";
        }
    }

    selectDate(date) {
        this.selectedDate = date;
        this.input.value = this.formatDate(date);
        this.hideDropdown();
    }

    formatDate(date) {
        const d = date.getDate().toString().padStart(2, "0");
        const m = (date.getMonth() + 1).toString().padStart(2, "0");
        const y = date.getFullYear();
        return `${d}/${m}/${y}`;
    }

    isSameDate(a, b) {
        return (
            a.getDate() === b.getDate() &&
            a.getMonth() === b.getMonth() &&
            a.getFullYear() === b.getFullYear()
        );
    }
}
