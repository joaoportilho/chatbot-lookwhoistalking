### Conteúdo:
- Formulário aplicado
- Respostas do formulário
- Resultado da query SQL para entender os reactions

```sql
SELECT id_prompt, 
	question, 
	response, 
	reaction, 
	dt_hr_prompt, 
	dt_hr_atualizacao 
FROM prompts WHERE 
usr_id not in (1,2) 
AND question in ('How to sort a array list using Java Language?', 
'How to a Java program to calculate average of numbers using Array?', 
'How to create a window with JFrame in Java?');
```