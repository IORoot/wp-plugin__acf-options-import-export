

<div id="top"></div>

<div align="center">

<div style="filter: invert(72%) sepia(53%) saturate(4524%) hue-rotate(125deg) brightness(106%) contrast(101%);">
<img src="https://cdn.jsdelivr.net/npm/@mdi/svg@6.7.96/svg/swap-vertical-bold.svg" style="width:200px;"/>
</div>

<h3 align="center">ACF options importer/exporter</h3>

<p align="center">
    Import and export ACF field date from the database directly.
</p>    
</div>

##  1. <a name='TableofContents'></a>Table of Contents


* 1. [Table of Contents](#TableofContents)
* 2. [About The Project](#AboutTheProject)
	* 2.1. [Built With](#BuiltWith)
	* 2.2. [Installation](#Installation)
* 3. [Usage](#Usage)
	* 3.1. [`[andyp_labs_stack]`](#andyp_labs_stack)
	* 3.2. [`[andyp_labs_rest]`](#andyp_labs_rest)
* 4. [Customising](#Customising)
* 5. [Troubleshooting](#Troubleshooting)
* 6. [Contributing](#Contributing)
* 7. [License](#License)
* 8. [Contact](#Contact)



##  2. <a name='AboutTheProject'></a>About The Project

Allows you to specify a comma separated list of options fields DATA to export to a json file.

You can then import that json file back into the database.

This is a super-dumb sql dump of all fields from the database with the name of your fields.

### Why?

I have a load of data filled in on my development installation and want to port over all of the
records to my staging and live servers without having to re-create all records by hand. This
allows me to just dump all of the fields out of the `wp_options` table in wordpress and import
them into another installation quite quickly.

<p align="right">(<a href="#top">back to top</a>)</p>



###  2.1. <a name='BuiltWith'></a>Built With

This project was built with the following frameworks, technologies and software.

* [ACF](https://www.advancedcustomfields.com/)
* [PHP](https://php.net/)
* [Wordpress](https://wordpress.org/)
* [Composer](https://getcomposer.org/)

<p align="right">(<a href="#top">back to top</a>)</p>



###  2.2. <a name='Installation'></a>Installation

These are the steps to get up and running with this plugin.

1. Clone the repo into your wordpress plugin folder
    ```sh
    git clone https://github.com/IORoot/wp-plugin__acf--inline-datetime-field ./wp-content/plugins/acf_datetime_inline
    ```
1. Activate the plugin.


<p align="right">(<a href="#top">back to top</a>)</p>



##  3. <a name='Usage'></a>Usage

A new menu item will appear under the ACF 'custom fields' menu call 'ACF import/export'.

### Exporting

Supply a comma separated list of field names to export.

```
my_field1, myrepeater, my_text_area1
```

Click export, and save the `options.json` file.

### Importing

Click on the button to upload your `options.json` file. Note it **MUST** be called `options.json` to work.

Click import.

    WARNING - ALL  EXISTING FIELDS OF THE SAME NAME WILL BE OVERWRITTEN.

### Repeaters

This is very handy for repeater fields. I usually place most things into top-level repeater fields. 
I can just specify the name of the top-level repeater field and it will automatically grab all
sub fields as well.

### Warnings

1. The import function runs a `insert_option` function on every record it finds in the json file.
2. The file to import MUST be called `options.json`. I know, thats lame, but it'll have to do for now.
3. I've used it with repeaters, groups, selects, text and textarea fields. It *Should* be ok with others, but haven't tested it.


##  4. <a name='Customising'></a> Customising

No customisation required.

##  5. <a name='Troubleshooting'></a>Troubleshooting

Nope. If you want to do some changes and make a merge request, go for it. But this is for my own purposes.

<p align="right">(<a href="#top">back to top</a>)</p>


##  6. <a name='Contributing'></a>Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue.
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



##  7. <a name='License'></a>License

Distributed under the MIT License.

MIT License

Copyright (c) 2022 Andy Pearson

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<p align="right">(<a href="#top">back to top</a>)</p>



##  8. <a name='Contact'></a>Contact

Author Link: [https://github.com/IORoot](https://github.com/IORoot)

<p align="right">(<a href="#top">back to top</a>)</p>
