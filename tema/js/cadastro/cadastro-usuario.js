const inputSkill        = document.getElementById("inputSkill");
const boxSkill          = document.getElementById("boxSkills");
const inputHiddenSkills = document.getElementById("inputSkillsHidden");
const btnAddskill       = document.getElementById("btnAdicionarSkill");

let skills = [];

/**
 * Responsavel por chamar a funcao de renderizacao da skill ao apertar enter
 */
inputSkill.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    e.preventDefault();
    let value = inputSkill.value.trim();

    if (value && !skills.includes(value)) {
      skills.push(value);
      renderSkills();
    }

    inputSkill.value = "";
  }
});

/**
 * Responsavel por chamar a funcao de renderizacao da skill ao clicar no botao de adicionar
 */
btnAddskill.addEventListener("click", function(e){
  e.preventDefault();
  let value = inputSkill.value.trim();

  if(value && !skills.includes(value)){
    skills.push(value);
    renderSkills();
  }

  inputSkill.value = "";
});

/**
 * Responsavel por adicionar o evento de click no x para remover a skill
 */
boxSkill.addEventListener("click", function (e) {
  if (e.target.tagName === "SPAN") {
    const skillToRemove = e.target.getAttribute("data-skill");
    skills = skills.filter(s => s !== skillToRemove);
    renderSkills();
  }
});

/**
 * Funcao responsavel por renderizar as Skills adicionadas no cadastro
 * @function renderSkills
 */
function renderSkills() {
  boxSkill.innerHTML = "";

  skills.forEach(skill => {
    let tag = document.createElement("div");
    tag.className = "tag";
    tag.innerHTML = `${skill} <span data-skill="${skill}">&times;</span>`;
    boxSkill.appendChild(tag);
  });

  inputHiddenSkills.value = JSON.stringify(skills);
}