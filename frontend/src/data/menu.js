/*
 * Main and demo navigation arrays
 *
 * 'to' attribute points to the route name, not the path url
 */

export default {
  main: [
    {
        name: "Tableaux de bords",
        heading: true,
      },
    {
      name: "Dashboard",
      to: "backend-dashboard",
      icon: "si si-speedometer",
    },
    // You can also set an external link to your main navigation and it will render as a link
    // {
    //   name: "Link Name",
    //   to: "https://example.com",
    //   icon: "si si-link",
    //   target: "_blank", // You can also set its target property
    // },

    {
      name: "PAGES",
      heading: true,
    },
    {
      name: "Clients",
      icon: "si si-user",
      subActivePaths: "/backend/blocks",
      sub: [
        {
          name: "liste des clients",
          to: "backend-blocks-styles",
        },
        {
          name: "Options",
          to: "backend-blocks-options",
        },
        {
          name: "Forms",
          to: "backend-blocks-forms",
        },
        {
          name: "Themed",
          to: "backend-blocks-themed",
        },
        {
          name: "API",
          to: "backend-blocks-api",
        },
      ],
    },
    {
        name: "Produits",
        icon: "si si-user",
        subActivePaths: "/backend/produits",
        sub: [
          {
            name: "Liste des produits",
            to: "backend-elements-liste",
          },
          {
            name: "Definition de prix",
            to: "backend-elements-defprix",
          },
          {
            name: "Valeur des produits",
            to: "backend-elements-valprix",
          },
        ],
      },

  ],

};
