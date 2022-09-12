# slotegrator-assignment

## Preparation todos
- [X] Prepare docker for two environments: dev and test
- [X] Decide which libraries to use
- [X] Decide architectural approach and directory structures
- [X] Prepare bootstrap


## Development todos
- [X] Sign up
- [X] Authentication
- [X] Gift
- [ ] Money
- [ ] Bonus
- [ ] Get random 
- [ ] Send money to users bank accounts
- [ ] Unit Tests
- [ ] Seeders and install command
- [ ] Load testing and fakers


- [ ] Frontend (dont have enough time to do it, we have REST and postman collection to test)
- [ ] Add money to programms balance (dont have enough time to do it, instead money will be added to programms balance via seeders)
- [ ] code sniffer and phpstan (dont have enough time to do it)
- [ ] foreign keys (dont have enough time to do it)

## Libraries
- [X] router
- [X] config
- [X] container
- [X] orm
- [X] migration
- [X] validation




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
