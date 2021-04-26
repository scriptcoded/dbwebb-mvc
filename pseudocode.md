# Pseudocode for Yatsy

```
func roll:
  user clicks roll button

  if roll count < 3
    if user chooses dice to reroll
      roll()
    elif user ends turn
      done()
  else
    done()
  
func done:
  if result is usable:
    user chooses row to store result in
  else
    user chooses row to strike

  decrease turn counter

  if turn count <= 0
    quit()
  else
    roll()
```