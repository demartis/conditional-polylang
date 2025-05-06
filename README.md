# Conditional Polylang – WordPress Plugin

**Version:** 1.3.0  
**Author:** Riccardo De Martis  
**LinkedIn URI:** [https://www.linkedin.com/in/rdemartis](https://www.linkedin.com/in/rdemartis)  
**Plugin URI:** [https://github.com/demartis/conditional-polylang](https://github.com/demartis/conditional-polylang)  
**License:** LGPL

---

## Quick Usage Example

Display different content based on the active Polylang language:

```html
[conditional_language]
  [if lang="en"]Content for English users.[/if]
  [if lang="es"]Contenido para usuarios en español.[/if]
  [if lang="fr"]Contenu pour les utilisateurs français.[/if]
  [else]Default content for users of other languages.[/else]
[/conditional_language]
````

---

## Installation

### Manual Installation via Releases

1. **Download the Plugin:**
   Get the latest release from the [Releases](https://github.com/demartis/conditional-polylang/releases) page.

2. **Extract the Archive:**
   Unzip the downloaded archive.

3. **Upload the Plugin:**
   Upload the `conditional-polylang` folder to your `/wp-content/plugins/` directory.

4. **Activate the Plugin:**
   Go to the **Plugins** menu in your WordPress admin area and activate **Conditional Polylang**.

---

## Usage

### Shortcodes Overview

The plugin provides a structured way to conditionally display content based on Polylang language codes.

#### `[conditional_language]` Container

Encapsulates all conditional checks and the fallback block. Inside it, use `[if]` and optionally `[else]`.

#### `[if lang="xx"]`

Outputs content only if the current language matches `xx` (e.g., `en`, `es`, `fr`).

#### `[else]`

Optional fallback content if no `[if]` matched.

> 🔒 Note: `[if]` and `[else]` only work inside `[conditional_language]`. They do **nothing** when used on their own.

---

### More Examples

#### Two-Language Example (English / Spanish)

```html
[conditional_language]
  [if lang="en"]Welcome to our site![/if]
  [if lang="es"]¡Bienvenido a nuestro sitio![/if]
  [else]Welcome! This is the fallback content.[/else]
[/conditional_language]
```

#### Multi-Language with Fallback

```html
[conditional_language]
  [if lang="en"]Order now![/if]
  [if lang="fr"]Commandez maintenant ![/if]
  [if lang="de"]Jetzt bestellen![/if]
  [else]Place your order in your language.[/else]
[/conditional_language]
```

#### Fallback Only

```html
[conditional_language]
  [else]This message appears for all languages not explicitly handled.[/else]
[/conditional_language]
```

---

## Helper Function for Developers

The plugin provides a function for use in PHP:

```php
if ( conditional_polylang_is_language( 'en' ) ) {
    // Code specific to English language
}
```

---

## Changelog

### 1.3.0

* Simplified shortcode syntax:

    * Replaced `[if_lang code="xx"]` with `[if lang="xx"]`
    * Replaced `[otherwise]` with `[else]`
* Enforced proper usage: `[if]` and `[else]` now only work inside `[conditional_language]`
* Removed legacy support for older shortcode names
* Updated documentation and examples accordingly

### 1.2.0

* Introduced `[if_lang]` with `code` attribute and `[otherwise]` for fallbacks
* Allowed `[if_lang]` usage outside containers

### 1.1.0

* Added container syntax: `[conditional_language]`, `[if_lang]`, `[else_lang]`

### 1.0.0

* Initial release of Conditional Polylang by Riccardo De Martis

---

## License

This plugin is licensed under the LGPL license.

---

## Support

For support or feature requests, please use the [GitHub Issues](https://github.com/demartis/conditional-polylang/issues) page.

