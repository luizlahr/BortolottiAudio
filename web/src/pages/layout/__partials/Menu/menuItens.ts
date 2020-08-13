interface IMenuItem {
  label: string;
  url: string;
  subs: Array<IMenuItem> | undefined;
}

export default <Array<IMenuItem>>[
  {
    label: "Painel",
    url: "/",
  },
  {
    label: "Clientes",
    url: "/customers",
  },
  {
    label: "Equipamentos",
    url: "/equipments",
    subs: [
      {
        label: "Categorias",
        url: "/equipments/categories",
      },
      {
        label: "Marcas",
        url: "/equipments/brands",
      },
      {
        label: "Modelos",
        url: "/equipments/models",
      },
    ],
  },
  {
    label: "Ordens",
    url: "/orders",
  },
  {
    label: "Fluxo de Trabalho",
    url: "/workflow",
  },
  {
    label: "Contas",
    url: "/bills",
    subs: [
      {
        label: "Pagar",
        url: "/bills/outcome",
      },
      {
        label: "Receber",
        url: "/bills/income",
      },
      {
        label: "Categorias",
        url: "/bills/categories",
      },
    ],
  },
  {
    label: "Contábil",
    url: "/accounting",
    subs: [
      {
        label: "Movimentações",
        url: "/accounting/movements",
      },
      {
        label: "Contas Bancárias",
        url: "/accounting/bank-accounts",
      },
    ],
  },
  {
    label: "Configurações",
    url: "settings",
    subs: [
      {
        label: "Usuários",
        url: "/settings/users",
      },
    ],
  }
]
