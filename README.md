# ACF options importer/exporter

Allows you to specify a comma separated list of options fields DATA to export to a json file.

You can then import that json file back into the database.

This is a super-dumb sql dump of all fields from the database with the name of your fields.

## Why?

I have a load of data filled in on my development installation and want to port over all of the
records to my staging and live servers without having to re-create all records by hand. This
allows me to just dump all of the fields out of the `wp_options` table in wordpress and import
them into another installation quite quickly.

## Repeaters

This is very handy for repeater fields. I usually place most things into top-level repeater fields. 
I can just specify the name of the top-level repeater field and it will automatically grab all
sub fields as well.


## Warnings

1. The import function runs a `insert_option` function on every record it finds in the json file.
2. The file to import MUST be called `options.json`. I know, thats lame, but it'll have to do for now.
3. I've used it with repeaters, groups, selects, text and textarea fields. It *Should* be ok with others, but haven't tested it.

## Support

Nope. If you want to do some changes and make a merge request, go for it. But this is for my own purposes.