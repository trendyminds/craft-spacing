# Spacing

## 🤔 What is this?
Like our [Design Tokens](https://github.com/trendyminds/craft-design-tokens) plugin, this is a Craft dropdown fieldtype where the options and the values are controllable via JSON files. However, it's highly specific if you use Matrix as a "page builder". This will render a "Top" and a "Bottom" dropdown in a single field and spare you from having to add two discrete spacing fields to every block one-by-one.

If you use Tailwind the JIT process only runs against Tailwind values it finds in your filesystem. If you have a class like `h-12` in your database there's nothing Tailwind can do to find that (unless you enable Project Config, but do you _really_ want Tailwind crawling your Project Config?).

Spacing allows you to define the values within JSON files on your filesystem, making it possible to use Tailwind's JIT process and provide a simple way to add and edit new values to your dropdowns.

## ⚠️ Careful, though!

Editing these JSON files means it's possible to break the output of your data. For example:

```diff
{
  "standard": "h-12",
+ "tighter": "h-6",
- "tight": "h-6",
  "none": "h-0"
}
```

Changing "tight" to "tighter" would break any entry using "tight"! Now when it tries to locate the value of "tight" it will come up empty until you've changed all of those values.

## 📝 Usage

To setup your spacing options, create a `config/spacing.json` file in your project.

```json
{
  "standard": "h-12",
  "tight": "h-6",
  "none": "h-0"
}
```

```twig
{# Outputs the value of the selected top option (h-12, h-6, h-0) #}
{{ entry.mySpacingField.top }}

{# Outputs the value of the selected bottom option (h-12, h-6, h-0) #}
{{ entry.mySpacingField.bottom }}

{# Outputs the entire configuration in config/spacing.json #}
{{ entry.mySpacingField.config }}
```

## 📦 Installing

Install Spacing in one of two ways:
- [Install via Craft's Plugin Store](https://plugins.craftcms.com/spacing)
- Run `composer require trendyminds/craft-spacing` and enable the plugin from "Settings > Plugins"

## 🤝 Contributing

If you'd like to contribute please submit a pull request for review. We try to review and accept contributions whenever possible!
