# ProyectoAsir
Repositorio del proyecto para ASIR 2022
Proyecto fin de grado superior José Manuel Fernández Cuesta
#¿Qué quiero hacer?.

Mi proyecto se basa en montar un sistema de alta disponibilidad y seguridad (usaremos una plataforma web, pero los conceptos son fácilmente extrapolables a otros tipos de servicios.), utilizando la plataforma AWS. 
#Finalidad.

Crearemos un sistema que tenga como objetivo satisfacer las necesidades de una entidad (Sea esta un individuo u organización) en la triada CIA (Confidencialidad, Integridad y disponibilidad) de la seguridad. Para cumplir estos tres requisitos propongo las siguientes implementaciones en una red interna.
#Objetivos.

Disponibilidad:
	La disponibilidad significa que cuando un usuario autorizado quiera acceder a los datos o a la información estos puedan hacerlo. Para este fin desplegare la siguiente infraestructura.
	Nuestro servicio será desplegado en contenedores (Docker) dentro de maquinas virtuales EC2 de Amazon.
	Con el fin de evitar que nuestras maquinas EC2 estén saturadas por culpa del trafico añadiremos el servicio de ECS (Elastic Container Service), Este servicio permitirá que cuando nuestras maquinas alcancen un gasto de CPU especifico se abra una replica de las mismas para tener mas donde distribuir la carga
	Con el fin de distribuirla instalaremos en la entrada al servicio un Balanceador de carga, este se ocupará de distribuir el tráfico entre diferentes los nodos que oferten el servicio.

Integridad:
	La integridad se centra en mantener los datos “Limpios”. Ningún usuario no autorizado va a poder cambiar la información de nuestros datos.
	Para cumplir esta necesidad implementaremos un servidor Foreman (Versión Open Source del servidor satélite de redhat). Enfocaré su uso en orquestar los cambios de la página web, aunque no descarto ampliar el uso del software conforme lo conozca más en cercanía.

Confidencialidad:
	La garantía de que personas no autorizadas no conozcan los datos. Estará protegida para que no se pueda distribuir.
	Primero nos aseguraremos de que los trabajadores que trabajen en remoto tengan un acceso a la red de la empresa vía OPENVPN, así tendremos cifrados los datos que estén usando los trabajadores en remoto evitando que sean accesible por agentes externos.
	Además, por motivos de seguridad extra instalare un SIEM Snort 3 que proteja la red de posibles intrusiones.
#Medios.

Para realizar este proyecto necesitare acceso a la plataforma AWS (Basta con la cuenta que ya tenemos disponibles). Además de acceso a internet y un dispositivo con el que conectarme tanto al panel de control web como a las instancias EC2 a través de conexión SSH.
#Planificación.
	Con finalidad de tener un timing de trabajo amplio he decidido distribuir los objetivos en semanas según la complejidad subjetiva que me proponen.

1.	Despliegue de la red: toda la infra estructura de dispositivos en la red AWS con su documentación (21-03/27-03)
2.	ECS: Investigación y despliegue del sistema ECS + Documentación (28-3/03-4).
3.	Balanceador de carga: Implementación del balanceador de carga, test de rendimiento y documentación (04-04/10-04)
4.	Investigación Servidor Foreman (18-04/24-04|01-05)
5.	Implementación Servidor Foreman + documentación (25-04|02-05/01-05|08-05)
6.	Investigación SIEM Snort (02-05|9-05/10-05|16-05|22-05).
7.	Implementación + fin de documentación (Hasta presentación de proyecto).
