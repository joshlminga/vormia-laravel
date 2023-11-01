
/* -----------------MATCH OPTIONS------------------------ */

const findMatches = (search, options) => {
	return options.filter(option => {
		let parent = option.getAttribute('parent');

        if(parent == 0) return option;

		const regex = new RegExp(search, "gi");
		return parent.match(regex);
	});
}

const filterOptions = (parentElement, childElement, options) => {
	options.forEach(option => {
		option.remove();
		option.selected = false;
	});
	// Parent Element attribute meta-url
	let parent_url = parentElement.querySelector('option:checked').getAttribute('meta-url');
	const matchArray = findMatches(parent_url, options);
	if (matchArray.length > 0) {
		options[0].text = "---- Select ----";
		options[0].value = '';
	} else {
		options[0].text = "--- ANY ---";
		options[0].value = 0;
	}
	matchArray.unshift(options[0]);
	childElement.append(...matchArray);
}


/* -------------------- FOR COUNTRY --------------------- */
let mainOptions = null;
let childwayOptions = null;
let mainurl = null;
let childwayurl = null;
// Get value Selected #this_main
let this_main = document.querySelector('#this_main');
mainurl = this_main.querySelector('option:checked').getAttribute('meta-url');

// Get value Selected #this_child_main
let this_child_main = document.querySelector('#this_child_main');
let this_child_main_active = this_child_main.querySelector('option:checked');

// Get Select [Child way] Options
mainOptions = Array.from(this_main.options);
childwayOptions = Array.from(this_child_main.options);

// Get selected
childwayOptions.forEach(option => {
	let parent = option.getAttribute('parent');

    console.log(mainurl);

	if (parent == mainurl) {
		return;
	} else if (option.value == "0") {
		return;
	} else {
		option.remove();
		option.selected = false;
	}
});

// OnChange
const thisSelectMain = section_this => {

	// Optionns
	let options = childwayOptions;

	childwayOptions.forEach(option => {
		option.remove();
		option.selected = false;
	});

	// Parent Element attribute meta-url
	let parent_url = section_this.querySelector('option:checked').getAttribute('meta-url');
	// console.log(parent_url,options);
	const matchArray = findMatches(parent_url, childwayOptions);

	// Create option elements
	matchArray.forEach(option => {
        document.getElementById("this_child_main").appendChild(option);
	});
}
