# Design System Document: The Editorial Voyager

This design system is a high-end framework crafted to transform the "utility" of travel booking into an "experience" of discovery. It moves away from the rigid, boxed-in layouts of traditional booking engines, favoring a fluid, layered, and editorial approach that evokes the depth of the ocean and the warmth of a sunset.

---

## 1. Creative North Star: "The Fluid Horizon"
The "Fluid Horizon" philosophy treats the interface not as a static grid, but as a series of overlapping, atmospheric layers. By utilizing **intentional asymmetry**, **Glassmorphism**, and **tonal depth**, we create an interface that feels as boundless as travel itself. We break the "template" look by allowing high-resolution imagery to bleed behind UI elements, using soft teals and deep sea blues to create a sense of trustworthy immersion.

---

## 2. Color & Atmospheric Surface Hierarchy

Our palette is rooted in the "Deep Sea" (`primary`) and "Coral" (`secondary`), but the sophistication lies in how we layer these tones.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders for sectioning or containment. 
Boundaries must be defined exclusively through:
*   **Background Shifts:** Transitioning from `surface` (#faf8ff) to `surface-container-low` (#f3f3fd).
*   **Tonal Nesting:** Placing a `surface-container-lowest` card on a `surface-container` background.
*   **Negative Space:** Utilizing the Spacing Scale (e.g., `spacing-12` or `16`) to create natural cognitive breaks.

### Surface Hierarchy & Layering
Treat the UI as a physical environment. Use the following tiers to define importance:
*   **Base Layer:** `surface` (#faf8ff) for general page backgrounds.
*   **Structural Layer:** `surface-container` (#ededf8) for sidebar backgrounds or large content sections.
*   **Interactive Layer:** `surface-container-lowest` (#ffffff) for primary cards to create a "lifted" feel.
*   **Glassmorphism:** For navigation bars and floating filters, use `surface` at 70% opacity with a `20px` backdrop-blur. This allows the "nature-inspired" imagery to peek through, maintaining a modern, airy feel.

### Signature Textures
Main CTAs and Hero sections should never be flat. Use a linear gradient: 
`primary` (#003d9b) → `primary-container` (#0052cc) at a 135° angle. This adds a "soulful" polish that reflects light on water.

---

## 3. Typography: The Editorial Voice

We utilize a dual-typeface system to balance authority with a welcoming, adventurous spirit.

*   **Display & Headlines (Plus Jakarta Sans):** Chosen for its modern, slightly geometric curves. Use `display-lg` (3.5rem) with tight letter-spacing (-0.02em) for hero titles to create an impactful, editorial "magazine" feel.
*   **Body & Labels (Inter):** The workhorse for readability. `body-lg` (1rem) is the standard for descriptions, ensuring a professional and trustworthy legibility.
*   **Hierarchy Note:** Always maintain a high contrast between `headline-lg` and `body-sm`. This dramatic scale shift is what separates high-end editorial design from generic web templates.

---

## 4. Elevation, Depth & The "Ghost Border"

We achieve hierarchy through **Tonal Layering** rather than structural lines.

*   **The Layering Principle:** To lift a component, do not reach for a shadow first. Instead, place a `surface-container-lowest` (#ffffff) element on a `surface-container-low` (#f3f3fd) background. The subtle shift in hex value creates a "natural lift."
*   **Ambient Shadows:** If a floating element (like a mobile booking bar) requires a shadow, it must be highly diffused: `blur: 40px`, `y: 10px`, `opacity: 6%`. The shadow color must be a tint of `on-surface` (#191b23), never pure black.
*   **The "Ghost Border" Fallback:** If a container is placed on an identical background color and requires definition, use the `outline-variant` token at **15% opacity**. High-contrast, 100% opaque borders are strictly forbidden.

---

## 5. Components

### Buttons
*   **Primary:** Rounded-xl (1.5rem). Background: Gradient (`primary` to `primary_container`). Text: `on-primary` (#ffffff).
*   **Secondary:** Rounded-xl (1.5rem). Background: `secondary_container` (#fe7e4f). This "Coral" pop is reserved for high-conversion actions (e.g., "Book Now").
*   **Tertiary:** No background. `title-sm` typography in `primary`. Interaction is indicated by a subtle `surface-variant` background shift on hover.

### Destination Cards
*   **Styling:** Forbid divider lines. Use `spacing-5` (1.7rem) of internal padding.
*   **Structure:** An image with `rounded-lg` (1rem) nested inside a `surface-container-lowest` card with `rounded-xl` (1.5rem). 
*   **Glass Overlay:** Place a glassmorphic badge (`surface` at 60% opacity) in the top-right corner for "Price" or "Rating."

### Input Fields & Search Bars
*   **Style:** `surface-container-highest` (#e1e2ec) backgrounds with `rounded-md` (0.75rem).
*   **Focus State:** Shift background to `surface-container-lowest` and add a `2px` "Ghost Border" using the `primary` color at 40% opacity. No harsh outlines.

### Search Chips
*   **Filter Chips:** Use `surface-container` with `rounded-full` (9999px). On selection, transition to `tertiary` (#004c48) with `on-tertiary` text to introduce the "Soft Teal" accent.

---

## 6. Do’s and Don’ts

### Do:
*   **Use Asymmetry:** Offset images and text blocks to create a sense of movement and adventure.
*   **Embrace White Space:** Use the large end of the spacing scale (`spacing-16` or `20`) between major sections to let the design "breathe."
*   **Prioritize Imagery:** Use the `tertiary` (Teal) and `secondary` (Coral) colors as "spice"—sparingly and intentionally against the "Deep Sea" (Blue) base.

### Don’t:
*   **Don't use 1px dividers:** Never use a line to separate two list items. Use a `0.35rem` background shift or vertical spacing instead.
*   **Don't use harsh corners:** Avoid anything below `rounded-md` (12px). Travel is organic; the UI should feel soft and approachable.
*   **Don't over-shadow:** If the layout looks "muddy," you have too many shadows. Revert to tonal layering (shifting background colors) to create depth.