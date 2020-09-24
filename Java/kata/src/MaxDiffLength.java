import java.util.Arrays;

/**
 * You are given two arrays a1 and a2 of strings. Each string is composed with letters from a to z. Let x be any string in the first array and y be any string in the second array.
 *
 * Find max(abs(length(x) − length(y)))
 *
 * If a1 and/or a2 are empty return -1 in each language except in Haskell (F#) where you will return Nothing (None).
 *
 * Example:
 * a1 = ["hoqq", "bbllkw", "oox", "ejjuyyy", "plmiis", "xxxzgpsssa", "xxwwkktt", "znnnnfqknaz", "qqquuhii", "dvvvwz"]
 * a2 = ["cccooommaaqqoxii", "gggqaffhhh", "tttoowwwmmww"]
 * mxdiflg(a1, a2) --> 13
 */
public class MaxDiffLength {
    public static void main(String[] args) {
        String[] s1 = new String[]{"hoqq", "bbllkw", "oox", "ejjuyyy", "plmiis", "xxxzgpsssa", "xxwwkktt", "znnnnfqknaz", "qqquuhii", "dvvvwz"};
        String[] s2 = new String[]{"cccooommaaqqoxii", "gggqaffhhh", "tttoowwwmmww"};
        System.out.println(MaxDiffLength.mxdiflg(s1, s2));
    }

    public static int mxdiflg(String[] a1, String[] a2) {
        // your code
        if (a1.length == 0 || a2.length == 0)
            return -1;
        String min_a1 = Arrays.stream(a1)
                .reduce(a1[0], (current, next) -> current.length() < next.length() ? current : next);
        String min_a2 = Arrays.stream(a2)
                .reduce(a2[0], (current, next) -> current.length() < next.length() ? current : next);
        String max_a1 = Arrays.stream(a1)
                .reduce(a1[0], (current, next) -> current.length() > next.length() ? current : next);
        String max_a2 = Arrays.stream(a2)
                .reduce(a2[0], (current, next) -> current.length() > next.length() ? current : next);
        return Math.max(Math.abs(max_a2.length() - min_a1.length()), Math.abs(max_a1.length() - min_a2.length()));
    }
}
