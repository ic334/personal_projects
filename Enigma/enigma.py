

class Rotor:
    """
    [rotor] represents an Enigma rotor
    """

    def __init__(self, wiring: str, turnover: str):
        self.wiring = wiring
        """
        A valid rotor wiring specification
        """
        self.turnover = turnover
        """
        the turnover of the rotor, which must be an uppercase letter
        """

    def __str__(self):
        return f'Rotor({self.wiring}, {self.turnover})'


class OrientedRotor:
    """
    [oriented_rotor] represents a rotor that is installed on the spindle hence
    has a top letter
    """

    def __init__(self, rotor: Rotor, top_letter: str):
        self.rotor = rotor
        """
        A valid rotor wiring specification
        """
        self.top_letter = top_letter
        """
        the top letter showing on the rotor
        """

    def __str__(self):
        return f'OrientedRotor({self.rotor}, {self.top_letter})'


class Config:
    """
    [config] represents the configuration of an Enigma machine.
    """

    def __init__(self, refl: str, rotors: list, plugboard: list):
        self.refl = refl
        """
        A valid reflector wiring specification
        """
        self.rotors = rotors
        """
        The rotors as they are installed on the spindle from left to right.
        There may be any number of elements in this list: 0, 1, 2, 3, 4, 5, etc.
        The order of elements in list represents the order in which the rotors
        are installed on the spindle, **from left to right**. So, the head of the
        list is the leftmost rotor on the spindle, and the last element of the
        list is the rightmost rotor on the spindle.
        """
        self.plugboard = plugboard
        """
        A valid plugboard. The order of characters in the pairs does not matter,
        and the order of pairs in the list does not matter.
        """

    def __str__(self):
        return f'Config({self.refl}, {self.rotors}, {self.plugboard})'


def index(c: str):
    """
    [index(c)] is the 0-based index of [c] in the alphabet.
    Requires: [c] is an uppercase letter in A..Z.
    """
    return ord(c)-65


def index_inverse(i: int):
    """
    [index_inverse(i)] is the uppercase letter in A..Z represented by
    integers 0..25 respectively.
    Requires: [i] is an integer in 0..25.
    """
    return chr(i+65)


def alphabet_modulo(position: int):
    """
    [alphabet_modulo(position)] is [position] mod 26 as a positive number in 0..25
    """
    if position > 25:
        return position % 26
    elif position < 0:
        return alphabet_modulo((position % 26) + 26)
    else:
        return position


def map_r_to_l(wiring: str, top_letter: str, input_pos: int):
    """
    [map_r_to_l(wiring, top_letter, input_pos)] is the left-hand output position
    at which current would appear when current enters at right-hand input
    position [input_pos] to a rotor whose wiring specification is given by
    [wiring].  The orientation of the rotor is given by [top_letter],
    which is the top letter appearing to the operator in the rotor's
    present orientation.
    Requires:
      [wiring] is a valid wiring specification,
      [top_letter] is in A..Z, and
      [input_pos] is in 0..25.
    """
    offset = index(top_letter)
    right_hand_contact = input_pos + offset
    left_hand_contact = index(wiring[alphabet_modulo(right_hand_contact)])
    left_hand_position = left_hand_contact - offset
    return alphabet_modulo(left_hand_position)


def map_l_to_r(wiring: str, top_letter: str, input_pos: int):
    """
    [map_l_to_r] computes the same function as [map_r_to_l], except
    for current flowing left to right.
    """
    offset = index(top_letter)
    left_hand_contact = input_pos + offset
    right_hand_contact = wiring[index_inverse(
        alphabet_modulo(left_hand_contact))]
    right_hand_position = right_hand_contact - offset
    return alphabet_modulo(right_hand_position)


def map_refl(wiring: str, input_pos: int):
    """
    map_refl(wiring, input_pos)] is the output position at which current would
    appear when current enters at input position [input_pos] to a reflector
    whose wiring specification is given by [wiring].
    Requires:
      [wiring] is a valid reflector specification, and
      [input_pos] is in 0..25.
    """
    return map_r_to_l(wiring, 'A', input_pos)


def map_plug(plugs: list, c: str):
    """
    [map_plug plugs c] is the letter to which [c] is transformed
    by the plugboard [plugs].
    Requires:
      [plugs] is a valid plugboard, and
      [c] is in A..Z.
    """
    if len(plugs) == 0:
        return c
    else:
        for i in range(len(plugs)):
            if c in plugs[i]:
                plug = plugs[i]
                return (plug.remove(c))[0]
    return c


def map_rotors_r_to_l(rotor_setup: list, input_pos: int):
    """
    [map_rotors_r_to_l(rotor_setup, input_pos)] is the left-hand output position
    at which current would appear when current enters at right-hand input
    position [input_pos] to a spindle of rotors whose wiring specification 
    is given by [rotor_setup].
    Requires: 
      [rotor_setup] is a valid list of oriented rotors, 
      [input_pos] is in 0..25.
    """
    current_output = input_pos
    if len(rotor_setup) == 0:
        return current_output
    else:
        return 'unimplemented'
        # for i in rotor_setup:
        #   map_r_to_l()
    return current_output


def map_rotors_l_to_r(rotor_setup: list, input_pos: int):
    """
    [map_rotors_l_to_r] computes the same function as [map_rotors_r_to_l],
    except for current flowing left to right. 
    """
    return None
