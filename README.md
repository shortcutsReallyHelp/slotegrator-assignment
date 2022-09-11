# slotegrator-assignment

## Preparation todos
- [X] Prepare docker for two environments: dev and test
- [X] Decide which libraries to use
- [X] Decide architectural approach and directory structures
- [X] Prepare bootstrap


## Development todos
- [ ] Sign up (30m)
- [ ] Authentication (30m)
- [ ] Get random gift (2h)
- [ ] Send money to users bank accounts (30m)
- [ ] Unit Tests (2h)
- [ ] Seeders and install command (30m)
- [ ] Load testing and fakers (2h)
- [ ] Settings (30m) (stub first)

- [ ] foreign keys

- [ ] code sniffer and phpstan (30m)
- [ ] Refactor Core (1h)
- [ ] Refactor Application (1h)


- [ ] Frontend (2h)

## Libraries
- [X] router
- [X] config
- [X] container
- [X] orm
- [X] migration
- [X] validation
- [X] OAuth 2.0
- [X] Event dispatcher
- [X] RabbitMQ
- [X] Redis




users
- id
- email
- password
- created_at
- updated_at

requisites
- id
- user_id
- data (json)

settings
- id
- key
- type
- value_int
- value_range_int_min
- value_range_int_max
- created_at
- updated_at

gifts
- id
- name
- balance
- created_at
- updated_at

gift_transactions
- id
- gift_id
- raffle_id
- amount
- gift_balance
- created_at
- updated_at

raffles
- id
- user_id
- type
- gift_id
- gift_name
- gift_amount
- money_amount
- money_transaction_id
- bonus_amount
- created_at
- updated_at

money_transactions
- id
- ?user_id
- amount
- balance
- created_at
- updated_at

bonus_transactions
- id
- user_id
- amount
- balance
- created_at
- updated_at
