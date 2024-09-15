document.addEventListener("DOMContentLoaded", function () {
  const addExerciseButton = document.getElementById("add-exercise");
  const exerciseList = document.getElementById("exercise-list");

  function createExerciseItem() {
    const listItem = document.createElement("li");
    listItem.classList.add("exercise-item");

    listItem.innerHTML = `
        <div>
            <h3 class="list-title">Choose an exercise:</h3>
            <select name="exercise_type[]" class="exercise" required>
                <option value="pushup">Push-ups</option>
                <option value="squat">Squats</option>
                <option value="deadlift">Deadlifts</option>
            </select>
        </div>
        <div>
            <h3 class="list-title">Number of series:</h3>
            <input type="number" name="series[]" class="sets" value="1" min="1" readonly>
            <button type="button" class="increase">+</button>
            <button type="button" class="decrease">-</button>
        </div>
        <div>
            <h3 class="list-title">Number of reps:</h3>
            <input type="number" name="reps[]" class="reps" value="10" min="1" readonly>
            <button type="button" class="increase-reps">+</button>
            <button type="button" class="decrease-reps">-</button>
        </div>
        <div class="removebut">
        <button type="button" class="remove-exercise">Remove Exercise</button>
        </div>
    `;

    // Event listeners for new exercise item
    listItem.querySelector(".increase").addEventListener("click", function () {
      const setsInput = listItem.querySelector(".sets");
      setsInput.value = parseInt(setsInput.value) + 1;
    });

    listItem.querySelector(".decrease").addEventListener("click", function () {
      const setsInput = listItem.querySelector(".sets");
      if (parseInt(setsInput.value) > 1) {
        setsInput.value = parseInt(setsInput.value) - 1;
      }
    });

    listItem
      .querySelector(".increase-reps")
      .addEventListener("click", function () {
        const repsInput = listItem.querySelector(".reps");
        repsInput.value = parseInt(repsInput.value) + 1;
      });

    listItem
      .querySelector(".decrease-reps")
      .addEventListener("click", function () {
        const repsInput = listItem.querySelector(".reps");
        if (parseInt(repsInput.value) > 1) {
          repsInput.value = parseInt(repsInput.value) - 1;
        }
      });

    listItem
      .querySelector(".remove-exercise")
      .addEventListener("click", function () {
        exerciseList.removeChild(listItem);
      });

    return listItem;
  }

  addExerciseButton.addEventListener("click", function () {
    const newExerciseItem = createExerciseItem();
    exerciseList.appendChild(newExerciseItem);
  });

  const form = document.getElementById("training-form");
  const resultMessage = document.getElementById("result-message");
});
