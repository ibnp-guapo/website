# Especificação Técnica 26: Remoção da "Escola Social de Guapó"

## 1. Contexto
A liderança da IBNP confirmou em 14/11/2026 que a **Escola Social de Guapó** (também chamada de "Escola Social e Infantil" ou "Escola Infantil em Guapó") **não existe**. O site a apresentava como projeto mantido pela igreja, com educação infantil, contraturno escolar e centro comunitário com auditório. Isso precisa sair por completo: divulgar um projeto inexistente engana as famílias e os parceiros e contraria as políticas do Google for Nonprofits / Ad Grants.

Esta especificação substitui, nesse ponto, as Specs 15, 17, 19 e 20, que citam a Escola Social. Os documentos antigos ficam como histórico.

## 2. Mudanças
- **Home:** o aviso "Escola Social de Guapó" vira "Ação Social em Guapó" (âncora `#acao-social-guapo`). A seção da escola, com os pilares Educação Infantil, Contraturno Escolar e Centro Comunitário & Auditório, foi trocada pelas ações que existem: **Natal Sem Fome**, **Coral de Natal Infantil** e **Guia de Chegada & Blog**.
- **Ação Social (`/acao-social`):** o card "Escola Infantil em Guapó (Mantenedores Oficiais)" vira "Ações Sociais em Guapó (Realizadas pela IBNP)", com destaque do Natal Sem Fome (`#natal-sem-fome`) e do Coral. Saem o aviso "página em elaboração pela mantenedora", os pilares "Mantenedores Locais" e "Educação Infantil" e o termo "mantenedores". A Escola Nova Esperança (Angola), que é real, continua.
- **Sobre (`/sobre`):** a seção "Mantenedora da Escola Social de Guapó" vira "Responsabilidade Social", e o card lateral vira "Ação Social da IBNP".
- **Rodapé:** sai "mantenedora legal da Escola Social de Guapó".

## 3. Regra para o futuro
Só publicar no site projetos e serviços que estejam funcionando. Propostas em estudo (por exemplo, um centro educacional no prédio da igreja) não entram no site até serem aprovadas e começarem a funcionar.

## 4. Testes
`PageRoutesTest` e `HttpRoutesTest` verificam a ausência de "Escola Social", "Escola Infantil em Guapó", "Contraturno Escolar", "Centro Comunitário" e "Mantenedores", e a presença das ações reais.
