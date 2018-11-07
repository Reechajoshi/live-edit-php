PramukhIME 3.0 (http://www.vishalon.net/PramukhIME/CKEditorPlugin.aspx)
Copyright (c) Vishal Monpara
CKEditor supported version: 3.x

Easily write in Assamese, Bengali, Bodo, Dogri, Gujarati, Hindi, Kannada, Konkani, Maithili, Malayalam, 
Manipuri, Marathi, Nepali, Oriya, Punjabi, Sanskrit, Santali, Sindhi, Tamil and Telugu with easy-to-use 
transliterate keyboard. There is no need to download any special software.

--------------------------------------------------------------------------------------------------------

Features:

    * Easily type in 20 Indian languages using "The way you speak, the way you type" rule.
	* Output is in Unicode and hence typed text can used anywhere
	* Unicode text <-> English transliteration is available with a single click.
	* Instead of typing using keyboard, user can click on letters to type desired word.
    * Detailed typing help available
    * Switch to normal english keyboard by pressing F9 (configurable)
    * Extremely fast typing
    * It's all magic of Javascript. End user does not need to install any software
	* Customizable plugin

Plugin Installation:
   1. Unzip the file on your local hard disk.
   2. Upload "pramukhime" folder to CKEditor_ROOT/plugins/
   3. In the init function for CKEditor (in the Webpage), add "pramukhime" in a plugin list and 
      add "pramukhime", "pramukhimeclick", "pramukhimeconvert" and "pramukhimehelp" button for 
	  language dropdown list, type using mouse, convert to another language and help button respectively

Plugin Customization:
   * Language list customization
     If you want to customize a list of language to be displayed in dropdown list, add "pramukhime_language" 
	 parameter in tinyMCE.init() function. Below is the parameter format 
	 pramukhime_language : [
            {
                jsfile : 'pramukhindic.js', // Required - Keyboard plugin js file name located at CKEditor_ROOT/plugins/pramukhime/js/
                kbclassname: 'PramukhIndic', // Required - Keyboard plugin class name. If this parameter does not exists,
				// it will be considered as a placeholder for "English"
                kbtitle: 'Indic Script', // Not required - Title given to the list of all languages
                languagelist: [	// Not required. - List of languages to be shown in the drop down
                    { language: "bengali"}, // "language" required
                    { language: "gujarati", title: "My Gujarati", defaultlanguage: true}, // "language" required, 
					// "title" not required, "defaultlanguage" not required
                    ],
					defaultlanguage: 'gujarati' // "defaultlanguage" not required. this overrides "defaultlanguage"
					// settings in individual language in "languagelist"
            },
			{ // This blank element will be considered as a placeholder for "English" in language drop down list
				kbtitle:'Roman' // Not required. If kbtitle: '', it will not create title, otherwise default title will be English
				title:'My English' // Not required
			}
        ],
   * Toggle Key customization
     If you want to customize the toggle key which is responsible for switching between selected language and English,
	 below is the parameter format
	 pramukhime_toggle_key : [
	        {
			    key : 119, // Required. F8 key's keycode
	            ctrl : false, // Not required. If true, user must press "Ctrl" key + key to switch
				alt : false,  // Not required. If true, user must press "Alt" key + key to switch
				title:' (F8)' // Not required. This title will be appended to the title of "English" language. Note: There is a space before "(F8)" text
		    }
		],

   
Feedback/Suggestions:

    Drop me few lines at http://www.vishalon.net/ContactMe.aspx