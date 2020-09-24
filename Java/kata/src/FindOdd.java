import java.util.Arrays;

/**
 * Given an array of integers, find the one that appears an odd number of times.
 *
 * There will always be only one integer that appears an odd number of times.
 */
public class FindOdd {
    public static void main(String[] args) {
        System.out.println(findIt(new int[]{20,1,-1,2,-2,3,3,5,5,1,2,4,20,4,-1,-2,5}));
    }

    public static int findIt(int[] a) {
        return Arrays.stream(a)
                .reduce(0, (current, next) -> current ^ next);
    }
}
