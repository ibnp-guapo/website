import json
import jsonschema

with open('data/programacao/agenda.schema.json', 'r', encoding='utf-8') as f:
    schema = json.load(f)

with open('data/programacao/agenda.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

# Validar com o validador Draft 2020-12
validator = jsonschema.Draft202012Validator(schema)
errors = list(validator.iter_errors(data))

if errors:
    print(f'ERROS ENCONTRADOS ({len(errors)}):')
    for err in errors:
        print(f'  - Campo: {".".join(str(p) for p in err.path)}: {err.message}')
    exit(1)

print('Validacao do JSON Schema: 100% SUCCESS!')
print(f'Organizacao: {data["organizacao"]["nome"]} ({data["organizacao"]["sigla"]})')
print(f'Cultos Regulares ({len(data["cultosRegulares"])}):')
for c in data["cultosRegulares"]:
    ao_vivo = " (Transmissao ao Vivo)" if c.get("transmissaoAoVivo") else ""
    print(f'  - [{c["diaSemana"].upper()}] {c["horario"]} - {c["nome"]}{ao_vivo} | RRULE: {c["rrule"]}')

print(f'Eventos Especiais: {len(data["eventosEspeciais"])}')
