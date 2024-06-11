# microservice-fizzbuzz

We spent so long optimizing fizzbuzz that we forgot what truly matters: making applications scalable by outsourcing heavy operations to external apis.

Here is a fizzbuzz solution that sends web requests to a maths api, instead of performing queries like `$number % 3` directly.

Next steps:
- outsource more code to apis
- add a load balancer
- add parallel requests
- integrate GPT 4 as a fallback api for maximum uptime (since it understands most tasks naturally, no maintenance will be required)
